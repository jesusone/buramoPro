<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\I18n\Date;

class DateTimeComponent extends Component
{

    protected $weekDays = array('day_0'=>'Monday','day_1'=>'Tuesday','day_2'=>'Wednesday','day_3'=>'Thursday','day_4'=>'Friday','day_5'=>'Saturday','day_6'=>'Sunday');

    /**
     * [datetime description]
     * @return [Object] [datetime]
     */
    public function datetime()
    {
        $ddate         = date("Y/m/d");
        $date          = new \DateTime($ddate);
        return $date;
    }
    /**
     * [nowDay description]
     * @return [int] [now day]
     */
    public function nowDay()
    {
        $date     = $this->datetime();
        $nowDay   = $date->format("Y-m-d");
        return $nowDay;
    }

    /**
     * [nowMonth description]
     * @return [int] [now month]
     */
    public function nowMonth()
    {
        $date     = $this->datetime();
        $nowMonth   = $date->format("m");
        return $nowMonth;
    }

    /**
     * [nowYear description]
     * @return [int] [now year]
     */
    public function nowYear()
    {
        $date     = $this->datetime();
        $nowYear   = $date->format("Y");
        return $nowYear;
    }

    /**
     * [nowWeek description]
     * @return [type] [description]
     */
    public function nowWeek()
    {
        $date      = $this->datetime();
        $nowWeek   = $date->format("W");
        return $nowWeek;
    }

    /**
     * [allDayInWeek description]
     * @return [type] [description]
     */
    public function allDayInWeek()
    {
        $week_number   = $this->nowWeek();
        $year          = $this->nowYear();
        for($day = 1; $day <= 7; $day++) {
            $days[]   = date('Y-m-d', strtotime($year."W".$week_number.$day));
        }
        return $days;
    }

    /**
     * [allDayInMonth description]
     * @return [type] [description]
     */
    public function allDayInMonth()
    {
        $month = $this->nowMonth();
        $year  = $this->nowYear();

        $start_date = "01-".$month."-".$year;
        $start_time = strtotime($start_date);
        $end_time   = strtotime("+1 month", $start_time);
        for($i = $start_time; $i<$end_time; $i+= 86400) {
            $list[] = date('Y-m-d', $i);
        }
        return $list;
    }

    /**
     * [getSeventDayFromNowday description]
     * @return [type] [description]
     */
    public function getSeventDayFromNowday()
    {
        $now        = date('Y-m-d');
        $start_date = strtotime($now);
        $end_date   = strtotime("+7 day", $start_date);
        for($i = $start_date; $i<$end_date; $i+= 86400) {
            $list[] = date('Y-m-d', $i);
        }
        return $list;
    }

    /**
     * [beginDayofWeek description]
     * @return [type] [description]
     */
    public function beginDayofWeek()
    {
        $week_number   = $this->nowWeek();
        $year          = $this->nowYear();
        for($day = 1; $day <= 7; $day++) {
            if ($day == 1) {
                $beginWeek   = date('Y-m-d', strtotime($year."W".$week_number.$day));
            }
        }
        return $beginWeek;
    }

    /**
     * [lastDayofWeek description]
     * @return [type] [description]
     */
    public function lastDayofWeek()
    {
        $week_number   = $this->nowWeek();
        $year          = $this->nowYear();
        for($day = 1; $day <= 7; $day++) {
            if ($day == 7) {
                $lastWeek   = date('Y-m-d', strtotime($year."W".$week_number.$day));
            }
        }
        return $lastWeek;
    }

    /**
     * [beginDayofThisMonth description]
     * @return [type] [description]
     */
    public function beginDayofThisMonth()
    {
        $dateBegin = strtotime("first day of this month");
        return date('Y-m-d', $dateBegin);
    }

    /**
     * [lastDayofThisMonth description]
     * @return [type] [description]
     */
    public function lastDayofThisMonth()
    {
        $dateEnd = strtotime("last day of this month");
        return date('Y-m-d', $dateEnd);
    }

    /**
     * [beginDayofThisYear description]
     * @return [type] [description]
     */
    public function beginDayofThisYear()
    {
        $dateBegin = strtotime("first day of january");
        return date('Y-m-d', $dateBegin);
    }

    /**
     * [lastDayofThisYear description]
     * @return [type] [description]
     */
    public function lastDayofThisYear()
    {
        $dateEnd = strtotime("last day of december");
        return date('Y-m-d', $dateEnd);
    }

    /**
     * get the last 12 months from now
     * @return [type] [description]
     */
    public function getLast12Month()
    {
        for ($i = 0; $i <= 11; $i++) {
            $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
        }
        return $months;
    }    

    /**
     * [get8DayAfterToday description]
     * @return [type] [description]
     */
    public function get8DayAfterToday()
    {
        $time = new date();
        $days[] = date('Y-m-d', strtotime($time));
        for($day = 0; $day <= 7; $day++) {
            $time->modify('+1 days');
            $days[]   = date('Y-m-d', strtotime($time));
        }
        return $days;
    }
}
