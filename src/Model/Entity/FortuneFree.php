<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Inflector;

/**
 * BrmUserFortuneFree Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $fortune_id
 * @property string $job
 * @property string $content
 * @property \Cake\I18n\Time $date_created
 * @property \Cake\I18n\Time $date_modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Fortune $fortune
 */
class FortuneFree extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'job' => true,
        'answer_title' => true,
        'answer_contents' => true,
        'username' => true,
        'content' => true,
        'user_id' => true
    ];
    protected $job,$user_id,$content;
    protected function _getJob($job)
    {
        return $job;
    }
    protected function _setJob($job)
    {
        return $job;
    }
    protected function _getUsername($username)
    {
        return $username;
    }
    protected function _setUsername($username)
    {
        return $username;
    }
    protected function _getContent($content)
    {
        return $content;
    }
    protected function _setContent($content)
    {
        return $content;
    }
    protected function _getFullName()
    {
        return $this->_properties['answer_title'] . '  ' .
        $this->_properties['answer_contents'];
    }

}
