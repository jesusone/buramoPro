<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BrmFortuneRanking Entity
 *
 * @property int $id
 * @property int $fortune_id
 * @property int $rank
 * @property int $rank_kind
 * @property int $delete_flg
 * @property \Cake\I18n\Time $date_created
 * @property \Cake\I18n\Time $date_modified
 *
 * @property \App\Model\Entity\Fortune $fortune
 */
class FortuneRanking extends Entity
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
