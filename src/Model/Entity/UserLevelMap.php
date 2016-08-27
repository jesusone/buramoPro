<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserLevelMap Entity
 *
 * @property int $id
 * @property int $level_id
 * @property int $user_id
 * @property bool $delete_flg
 * @property \Cake\I18n\Time $date_created
 * @property \Cake\I18n\Time $date_updated
 *
 * @property \App\Model\Entity\Level $level
 * @property \App\Model\Entity\User $user
 */
class UserLevelMap extends Entity
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
        'id' => false
    ];
}