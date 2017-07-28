<?php

namespace App\Models;

use ArrayAccess;
use Illuminate\Support\Str;
use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

use Illuminate\Support\Collection as BaseCollection;
use Illuminate\Database\Eloquent\JsonEncodingException;


/**
 * Class SimpleModel
 *
 * A model like the Eloquent model without events, attributes restrictions (visible, fillabel, hidden, etc.) and database features.
 * Featuring attribute casting, mutators, json attributes writing and reading.
 *
 * @package App\Models
 */
abstract class SimpleModel implements ArrayAccess, Arrayable, Jsonable, JsonSerializable
{
	/**
	 * The model's attributes.
	 *
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * The model attribute's original state.
	 *
	 * @var array
	 */
	protected $original = [];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [];

	/**
	 * Indicates whether attributes are snake cased on arrays.
	 *
	 * @var bool
	 */
	public static $snakeAttributes = true;

	/**
	 * The cache of the mutated attributes for each class.
	 *
	 * @var array
	 */
	protected static $mutatorCache = [];

	/**
	 * Create a new model instance.
	 *
	 * @param  array  $attributes
	 * @return void
	 */
	public function __construct(array $attributes = [])
	{
		$this->syncOriginal();

		$this->fill($attributes);
	}

	/**
	 * Sync the original attributes with the current.
	 *
	 * @return $this
	 */
	public function syncOriginal()
	{
		$this->original = $this->attributes;

		return $this;
	}

	/**
	 * Fill the model with an array of attributes.
	 *
	 * @param  array  $attributes
	 * @return $this
	 *
	 * @throws \Illuminate\Database\Eloquent\MassAssignmentException
	 */
	public function fill(array $attributes)
	{
		foreach ($attributes as $key => $value) {
			$this->setAttribute($key, $value);
		}

		return $this;
	}

	/**
	 * Convert the model's attributes to an array.
	 *
	 * @return array
	 */
	public function attributesToArray()
	{
		$attributes = $this->getArrayableAttributes();

		$attributes = $this->addMutatedAttributesToArray(
			$attributes, $mutatedAttributes = $this->getMutatedAttributes()
		);

		// Next we will handle any casts that have been setup for this model and cast
		// the values to their appropriate type. If the attribute has a mutator we
		// will not perform the cast on those attributes to avoid any confusion.
		$attributes = $this->addCastAttributesToArray(
			$attributes, $mutatedAttributes
		);

		// Here we will grab all of the appended, calculated attributes to this model
		// as these attributes are not really in the attributes array, but are run
		// when we need to array or JSON the model for convenience to the coder.
		foreach ($this->getArrayableAppends() as $key) {
			$attributes[$key] = $this->mutateAttributeForArray($key, null);
		}

		return $attributes;
	}

	/**
	 * Get an attribute array of all arrayable attributes.
	 *
	 * @return array
	 */
	protected function getArrayableAttributes()
	{
		return $this->attributes;
	}

	/**
	 * Get all of the appendable values that are arrayable.
	 *
	 * @return array
	 */
	protected function getArrayableAppends()
	{
		if (! count($this->appends)) {
			return [];
		}

		return array_combine($this->appends, $this->appends);
	}

	/**
	 * Add the casted attributes to the attributes array.
	 *
	 * @param  array  $attributes
	 * @param  array  $mutatedAttributes
	 * @return array
	 */
	protected function addCastAttributesToArray(array $attributes, array $mutatedAttributes)
	{
		foreach ($this->getCasts() as $key => $value) {
			if (! array_key_exists($key, $attributes) || in_array($key, $mutatedAttributes)) {
				continue;
			}

			// Here we will cast the attribute. Then, if the cast is a date or datetime cast
			// then we will serialize the date for the array. This will convert the dates
			// to strings based on the date format specified for these Eloquent models.
			$attributes[$key] = $this->castAttribute(
				$key, $attributes[$key]
			);
		}

		return $attributes;
	}

	/**
	 * Get the mutated attributes for a given instance.
	 *
	 * @return array
	 */
	public function getMutatedAttributes()
	{
		$class = static::class;

		if (! isset(static::$mutatorCache[$class])) {
			static::cacheMutatedAttributes($class);
		}

		return static::$mutatorCache[$class];
	}

	/**
	 * Extract and cache all the mutated attributes of a class.
	 *
	 * @param  string  $class
	 * @return void
	 */
	public static function cacheMutatedAttributes($class)
	{
		static::$mutatorCache[$class] = collect(static::getMutatorMethods($class))->map(function ($match) {
			return lcfirst(static::$snakeAttributes ? Str::snake($match) : $match);
		})->all();
	}

	/**
	 * Get all of the attribute mutator methods.
	 *
	 * @param  mixed  $class
	 * @return array
	 */
	protected static function getMutatorMethods($class)
	{
		preg_match_all('/(?<=^|;)get([^;]+?)Attribute(;|$)/', implode(';', get_class_methods($class)), $matches);

		return $matches[1];
	}

	/**
	 * Add the mutated attributes to the attributes array.
	 *
	 * @param  array  $attributes
	 * @param  array  $mutatedAttributes
	 * @return array
	 */
	protected function addMutatedAttributesToArray(array $attributes, array $mutatedAttributes)
	{
		foreach ($mutatedAttributes as $key) {
			// We want to spin through all the mutated attributes for this model and call
			// the mutator for the attribute. We cache off every mutated attributes so
			// we don't have to constantly check on attributes that actually change.
			if (! array_key_exists($key, $attributes)) {
				continue;
			}

			// Next, we will call the mutator for this attribute so that we can get these
			// mutated attribute's actual values. After we finish mutating each of the
			// attributes we will return this final array of the mutated attributes.
			$attributes[$key] = $this->mutateAttributeForArray(
				$key, $attributes[$key]
			);
		}

		return $attributes;
	}

	/**
	 * Get the value of an attribute using its mutator for array conversion.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return mixed
	 */
	protected function mutateAttributeForArray($key, $value)
	{
		$value = $this->mutateAttribute($key, $value);

		return $value instanceof Arrayable ? $value->toArray() : $value;
	}

	/**
	 * Dynamically retrieve attributes on the model.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function __get($key)
	{
		return $this->getAttribute($key);
	}

	/**
	 * Get an attribute from the model.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function getAttribute($key)
	{
		if (! $key) {
			return;
		}

		// If the attribute exists in the attribute array or has a "get" mutator we will
		// get the attribute's value. Otherwise, we will proceed as if the developers
		// are asking for a relationship's value. This covers both types of values.
		if (array_key_exists($key, $this->attributes) ||
			$this->hasGetMutator($key)) {
			return $this->getAttributeValue($key);
		}

		// Here we will determine if the model base class itself contains this given key
		// since we do not want to treat any of those methods are relationships since
		// they are all intended as helper methods and none of these are relations.
		if (method_exists(self::class, $key)) {
			return;
		}

		return;
	}

	/**
	 * Determine if a get mutator exists for an attribute.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public function hasGetMutator($key)
	{
		return method_exists($this, 'get'.Str::studly($key).'Attribute');
	}

	/**
	 * Get a plain attribute (not a relationship).
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function getAttributeValue($key)
	{
		$value = $this->getAttributeFromArray($key);

		// If the attribute has a get mutator, we will call that then return what
		// it returns as the value, which is useful for transforming values on
		// retrieval from the model to a form that is more useful for usage.
		if ($this->hasGetMutator($key)) {
			return $this->mutateAttribute($key, $value);
		}

		// If the attribute exists within the cast array, we will convert it to
		// an appropriate native PHP type dependant upon the associated value
		// given with the key in the pair. Dayle made this comment line up.
		if ($this->hasCast($key)) {
			return $this->castAttribute($key, $value);
		}

		return $value;
	}

	/**
	 * Cast an attribute to a native PHP type.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return mixed
	 */
	protected function castAttribute($key, $value)
	{
		if (is_null($value)) {
			return $value;
		}

		switch ($this->getCastType($key)) {
			case 'int':
			case 'integer':
				return (int) $value;
			case 'real':
			case 'float':
			case 'double':
				return (float) $value;
			case 'string':
				return (string) $value;
			case 'bool':
			case 'boolean':
				return (bool) $value;
			case 'object':
				return $this->fromJson($value, true);
			case 'array':
			case 'json':
				return $this->fromJson($value);
			case 'collection':
				return new BaseCollection($this->fromJson($value));
			case 'date':
				return $this->asDate($value);
			case 'datetime':
				return $this->asDateTime($value);
			case 'timestamp':
				return $this->asTimestamp($value);
			default:
				return $value;
		}
	}

	/**
	 * Get the value of an attribute using its mutator.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return mixed
	 */
	protected function mutateAttribute($key, $value)
	{
		return $this->{'get'.Str::studly($key).'Attribute'}($value);
	}


	/**
	 * Get an attribute from the $attributes array.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	protected function getAttributeFromArray($key)
	{
		if (isset($this->attributes[$key])) {
			return $this->attributes[$key];
		}
	}

	/**
	 * Dynamically set attributes on the model.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return void
	 */
	public function __set($key, $value)
	{
		$this->setAttribute($key, $value);
	}

	/**
	 * Set a given attribute on the model.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return $this
	 */
	public function setAttribute($key, $value)
	{
		// First we will check for the presence of a mutator for the set operation
		// which simply lets the developers tweak the attribute as it is set on
		// the model, such as "json_encoding" an listing of data for storage.
		if ($this->hasSetMutator($key)) {
			$method = 'set'.Str::studly($key).'Attribute';

			return $this->{$method}($value);
		}

		if ($this->isJsonCastable($key) && ! is_null($value)) {
			$value = $this->castAttributeAsJson($key, $value);
		}

		// If this attribute contains a JSON ->, we'll set the proper value in the
		// attribute's underlying array. This takes care of properly nesting an
		// attribute in the array's value in the case of deeply nested items.
		if (Str::contains($key, '->')) {
			return $this->fillJsonAttribute($key, $value);
		}

		$this->attributes[$key] = $value;

		return $this;
	}

	/**
	 * Set a given JSON attribute on the model.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return $this
	 */
	public function fillJsonAttribute($key, $value)
	{
		list($key, $path) = explode('->', $key, 2);

		$this->attributes[$key] = $this->asJson($this->getArrayAttributeWithValue(
			$path, $key, $value
		));

		return $this;
	}

	/**
	 * Get an array attribute with the given key and value set.
	 *
	 * @param  string  $path
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return $this
	 */
	protected function getArrayAttributeWithValue($path, $key, $value)
	{
		return tap($this->getArrayAttributeByKey($key), function (&$array) use ($path, $value) {
			Arr::set($array, str_replace('->', '.', $path), $value);
		});
	}

	/**
	 * Get an array attribute or return an empty array if it is not set.
	 *
	 * @param  string  $key
	 * @return array
	 */
	protected function getArrayAttributeByKey($key)
	{
		return isset($this->attributes[$key]) ?
			$this->fromJson($this->attributes[$key]) : [];
	}

	/**
	 * Decode the given JSON back into an array or object.
	 *
	 * @param  string  $value
	 * @param  bool  $asObject
	 * @return mixed
	 */
	public function fromJson($value, $asObject = false)
	{
		return json_decode($value, ! $asObject);
	}

	/**
	 * Determine whether a value is JSON castable for inbound manipulation.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	protected function isJsonCastable($key)
	{
		return $this->hasCast($key, ['array', 'json', 'object', 'collection']);
	}

	/**
	 * Determine whether an attribute should be cast to a native type.
	 *
	 * @param  string  $key
	 * @param  array|string|null  $types
	 * @return bool
	 */
	public function hasCast($key, $types = null)
	{
		if (array_key_exists($key, $this->getCasts())) {
			return $types ? in_array($this->getCastType($key), (array) $types, true) : true;
		}

		return false;
	}

	/**
	 * Get the type of cast for a model attribute.
	 *
	 * @param  string  $key
	 * @return string
	 */
	protected function getCastType($key)
	{
		return trim(strtolower($this->getCasts()[$key]));
	}

	/**
	 * Get the casts array.
	 *
	 * @return array
	 */
	public function getCasts()
	{
		return $this->casts;
	}

	/**
	 * Cast the given attribute to JSON.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return string
	 */
	protected function castAttributeAsJson($key, $value)
	{
		$value = $this->asJson($value);

		if ($value === false) {
			throw JsonEncodingException::forAttribute(
				$this, $key, json_last_error_msg()
			);
		}

		return $value;
	}

	/**
	 * Determine if a set mutator exists for an attribute.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public function hasSetMutator($key)
	{
		return method_exists($this, 'set'.Str::studly($key).'Attribute');
	}

	/**
	 * Determine if the given attribute exists.
	 *
	 * @param  mixed  $offset
	 * @return bool
	 */
	public function offsetExists($offset)
	{
		return isset($this->$offset);
	}

	/**
	 * Get the value for a given offset.
	 *
	 * @param  mixed  $offset
	 * @return mixed
	 */
	public function offsetGet($offset)
	{
		return $this->$offset;
	}

	/**
	 * Set the value for a given offset.
	 *
	 * @param  mixed  $offset
	 * @param  mixed  $value
	 * @return void
	 */
	public function offsetSet($offset, $value)
	{
		$this->$offset = $value;
	}

	/**
	 * Unset the value for a given offset.
	 *
	 * @param  mixed  $offset
	 * @return void
	 */
	public function offsetUnset($offset)
	{
		unset($this->$offset);
	}

	/**
	 * Determine if an attribute or relation exists on the model.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public function __isset($key)
	{
		return ! is_null($this->getAttribute($key));
	}

	/**
	 * Unset an attribute on the model.
	 *
	 * @param  string  $key
	 * @return void
	 */
	public function __unset($key)
	{
		unset($this->attributes[$key], $this->relations[$key]);
	}

	/**
	 * Handle dynamic method calls into the model.
	 *
	 * @param  string  $method
	 * @param  array  $parameters
	 * @return mixed
	 */
	public function __call($method, $parameters)
	{
		if (in_array($method, ['increment', 'decrement'])) {
			return $this->$method(...$parameters);
		}

		return $this->newQuery()->$method(...$parameters);
	}

	/**
	 * Handle dynamic static method calls into the method.
	 *
	 * @param  string  $method
	 * @param  array  $parameters
	 * @return mixed
	 */
	public static function __callStatic($method, $parameters)
	{
		return (new static)->$method(...$parameters);
	}

	/**
	 * Convert the model to its string representation.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->toJson();
	}

	/**
	 * Convert the model instance to an array.
	 *
	 * @return array
	 */
	public function toArray()
	{
		return $this->attributesToArray();
	}

	/**
	 * Convert the model instance to JSON.
	 *
	 * @param  int  $options
	 * @return string
	 *
	 * @throws \Illuminate\Database\Eloquent\JsonEncodingException
	 */
	public function toJson($options = 0)
	{
		$json = json_encode($this->jsonSerialize(), $options);

		if (JSON_ERROR_NONE !== json_last_error()) {
			throw JsonEncodingException::forModel($this, json_last_error_msg());
		}

		return $json;
	}

	/**
	 * Convert the object into something JSON serializable.
	 *
	 * @return array
	 */
	public function jsonSerialize()
	{
		return $this->toArray();
	}

}
