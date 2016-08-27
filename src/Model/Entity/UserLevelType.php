<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BrmUserLevelType Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $coin_start
 * @property int $coin_end
 * @property int $coin_bonus
 * @property string $image
 * @property bool $delete_flg
 * @property \Cake\I18n\Time $date_created
 * @property \Cake\I18n\Time $date_updated
 */
class UserLevelType extends Entity
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
