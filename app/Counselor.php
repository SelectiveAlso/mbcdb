<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Save;

class Counselor extends Model {

  protected $fillable = [
    'name',
    'first_name',
    'last_name',
    'address',
    'city',
    'state',
    'zip',
    'ypt'
  ];

  // Relationships

  public function badges()
  {
    return $this->belongsToMany("App\Badge");
  }

  public function district()
  {
    return $this->belongsTo('App\District');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function isChildOf(User $user)
  {
    if ($user->id == $this->user_id) {
      return true;
    } else {
      return false;
    }
  }

  public static function getFields()
  {
		$fields = [
			'last_name',
			'name',
			'unit_num',
			'first_name',
			'address',
			'city',
			'state',
			'zip',
			'email',
			'primary_phone',
			'secondary_phone',
			'bsa_id',
		];
    return $fields;
  }

	public function Council()
	{
		return $this->belongsTo('App\Council');
	}

  public static function alphabetizeBy($class)
  {
    switch ($class) {
      case 'name':
        $counselors = Counselor::with('district.council')->orderBy('last_name', 'ASC')->paginate(35);
        break;

      case 'district':
        $counselors = Counselor::with('district.council')->orderBy('district_id', 'DESC')->paginate(35);
        break;

      case 'troop':
        // Thank you to @bestmomo on stack overflow
        $counselors = Counselor::with('district.council')->orderBy(DB::raw('LENGTH(unit_num), unit_num'))->paginate(35);
        break;

      default:
        $counselors = Counselor::with('district.council')->orderBy('last_name', 'ASC')->paginate(35);
        break;
    }
    return $counselors;
  }


  public function saves()
  {
    return $this->hasMany(Save::class);
  }

  public function hasYPT() {
    if ($this->ypt == true) {
      return true;
    }
    return false;
  }

  public function teaches($badge) {
    $badges = $this->badges;
    foreach ($badges as $counselorBadge) {
      if ($counselorBadge->name == $badge) {
        return true;
      }
    }
    return false;
  }
}
