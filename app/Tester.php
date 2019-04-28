<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Tester extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','rate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $type ="tester";
    public function testResults()
    {
        return $this->hasMany('App\TestResult');
    }
    public function tests()
    {
        return $this->hasMany('App\Test','client_id');
    }
    public function testReviews()
    {
        return $this->hasMany('App\TestReview','tester_id');
    }
    public function updateRate()
    {
        $testReviews=$this->testReviews();
        $sum=$count=0;

        foreach($testReviews as $testReview)
        {
            $val=$testReview->testerRate;
            if($val !=0){
                $count+=1;
                $sum+=$val;
            }
        }
        if($count != 0){
            $this->rate=$sum/$count;
        }else{
            $this->rate = 0;
        }
        $this->save();
        return $this->rate;
    }
}
