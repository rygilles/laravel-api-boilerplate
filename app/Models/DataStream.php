<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

/**
 * Class DataStream
 * @package App\Models
 */
class DataStream extends ApiModel
{
	use UuidModelTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'data_stream';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'data_stream_decoder_id',
		'name',
		'feed_url'
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;

	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;

	/**
	 * Model fillable fields for new items
	 * @var array
	 */
	protected static $storeFillable = [
		'data_stream_decoder_id',
		'name',
		'feed_url'
	];

	/**
	 * Model fillable fields for item patch
	 * @var array
	 */
	protected static $patchFillable = [
		'data_stream_decoder_id',
		'name',
		'feed_url'
	];

	/**
	 * Model fillable fields for item replacement
	 * @var array
	 */
	protected static $putFillable = [
		'data_stream_decoder_id',
		'name',
		'feed_url'
	];

	/**
	 * Model validation rules for new items
	 * @var string[]
	 */
	protected static $storeRules = [
		'data_stream_decoder_id'    => 'required|uuid|exists:data_stream_decoder,id',
		'name'                      => 'required|string|max:200',
		'feed_url'                  => 'required|url'
	];

	/**
	 * Model validation rules for item patch
	 * @var string[]
	 */
	protected static $patchRules = [
		'data_stream_decoder_id'    => 'uuid|exists:data_stream_decoder,id',
		'name'                      => 'string|max:200',
		'feed_url'                  => 'url'
	];

	/**
	 * Model validation rules for item replacement
	 * @var string[]
	 */
	protected static $putRules = [
		'data_stream_decoder_id'    => 'required|uuid|exists:data_stream_decoder,id',
		'name'                      => 'required|string|max:200',
		'feed_url'                  => 'required|url'
	];

	/**
	 * Get the project of this data stream
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\hasOne
	 */
	public function project()
	{
		return $this->hasOne(Project::class);
	}

	/**
	 * Get the data stream decoder of this data stream
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function dataStreamDecoder()
	{
		return $this->belongsTo(DataStreamDecoder::class);
	}

	/**
	 * Get the relationships between this data stream and his i18n langs
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function dataStreamHasI18nLangs()
	{
		return $this->hasMany(DataStreamHasI18nLang::class);
	}

	/**
	 * Get the i18n langs of this data stream using relationship table
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function i18nLangs()
	{
		return $this->belongsToMany(I18nLang::class, 'data_stream_has_i18n_lang', 'data_stream_id', 'i18n_lang_id');
	}

	/**
	 * Get the data stream fields of this data stream
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function dataStreamFields()
	{
		return $this->hasMany(DataStreamField::class);
	}

	/**
	 * Scope a query to include authorized access
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string[] $authorizedUserRolesIds User roles ids authorized to access to this route/resource
	 * @param string[] $exceptUserGroupsIds User groups ids authorized to access to this route
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeAuthorized($query, $authorizedUserRolesIds = ['Owner', 'Administrator'], $exceptUserGroupsIds = ['Developer', 'Support'])
	{
		// Apply query scope if user group id isn't authorized
		if (!in_array(Auth::user()->user_group_id, $exceptUserGroupsIds)) {
			return $query->whereHas('project.hasUserProjects', function ($query) use ($authorizedUserRolesIds) {
				$query->where('user_id', Auth::user()->id)
					->whereIn('user_role_id', $authorizedUserRolesIds);
			});
		}

		return $query;
	}
}
