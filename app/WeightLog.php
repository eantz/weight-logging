<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;

class WeightLog extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function getUserWeightLogs(User $user)
    {
        return WeightLog::where('user_id', $user->id)
            ->orderBy('log_date', 'desc')
            ->get();
    }

    public static function getAverageUserWeightLogs(User $user)
    {
        return WeightLog::selectRaw(
                DB::raw('AVG(max) as avg_max, AVG(min) as avg_min, AVG(variance) as avg_variance')
            )
            ->where('user_id', $user->id)
            ->first();
    }
}
