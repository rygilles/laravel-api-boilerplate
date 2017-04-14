<?php

namespace App\Http;
use InvalidArgumentException;

/**
 * Custom validators methods
 * @package App\Http
 */
class CustomValidator
{
	/**
	 * Custom validation : UUID
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @param array $parameters
	 * @param \Illuminate\Validation\Validator $validator
	 * @return bool
	 */
	public function validateUUID($attribute, $value, $parameters, $validator)
	{
		return (preg_match('/^[0-9a-f]{8}-([0-9a-f]{4}-){3}[0-9a-f]{12}$/', $value));
	}

	/**
	 * Custom validation : md5
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @param array $parameters
	 * @param \Illuminate\Validation\Validator $validator
	 * @return bool
	 */
	public function validateMd5($attribute, $value, $parameters, $validator)
	{
		return (preg_match('/^[a-f0-9]{32}$/i', $value));
	}

	/**
	 * Custom strength validation for passwords
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @param array $parameters
	 * @param \Illuminate\Validation\Validator $validator
	 * @return bool
	 */
	public function validateStrength($attribute, $value, $parameters, $validator)
	{
		// 8+ chars min | 1 numeric min | 1 uppercase min | 1 lowercase min
		return (preg_match('/(?=.*\d)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $value));
	}

	/**
	 * Custom validation : Uppercase char min
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @param array $parameters
	 * @param \Illuminate\Validation\Validator $validator
	 * @return bool
	 */
	public function validateUppercaseMin($attribute, $value, $parameters, $validator)
	{
		$validator->addReplacer('uppercase_min', function($message, $attribute, $rule, $parameters) {
			return str_replace(':uppercase_min', $parameters[0], $message);
		});

		$this->requireParameterCount(1, $parameters, 'uppercase_min');

		return (preg_match('/([A-Z]){' . $parameters[0] . ',}/', $value));
	}

	/**
	 * Custom validation : Lowercase char min
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @param array $parameters
	 * @param \Illuminate\Validation\Validator $validator
	 * @return bool
	 */
	public function validateLowercaseMin($attribute, $value, $parameters, $validator)
	{
		$validator->addReplacer('lowercase_min', function($message, $attribute, $rule, $parameters) {
			return str_replace(':lowercase_min', $parameters[0], $message);
		});

		$this->requireParameterCount(1, $parameters, 'lowercase_min');

		return (preg_match('/([a-z]){' . $parameters[0] . ',}/', $value));
	}

	/**
	 * Custom validation : Numeric char min
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @param array $parameters
	 * @param \Illuminate\Validation\Validator $validator
	 * @return bool
	 */
	public function validateNumericMin($attribute, $value, $parameters, $validator)
	{
		$validator->addReplacer('numeric_min', function($message, $attribute, $rule, $parameters) {
			return str_replace(':numeric_min', $parameters[0], $message);
		});

		$this->requireParameterCount(1, $parameters, 'numeric_min');

		return (preg_match('/([0-9]){' . $parameters[0] . ',}/', $value));
	}

	/**
	 * Require a certain number of parameters to be present.
	 *
	 * @param  int $count
	 * @param  array $parameters
	 * @param  string $rule
	 * @throws InvalidArgumentException
	 */
	protected function requireParameterCount($count, $parameters, $rule)
	{
		if (count($parameters) < $count) {
			throw new InvalidArgumentException("Validation rule $rule requires at least $count parameters.");
		}
	}
}