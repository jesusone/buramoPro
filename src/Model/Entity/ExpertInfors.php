<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BrmFortuneExpertInfo Entity
 *
 * @property int $id
 * @property int $fortune_id
 * @property int $expert_id
 * @property \Cake\I18n\Time $date_created
 * @property \Cake\I18n\Time $date_modified
 *
 * @property \App\Model\Entity\Fortune $fortune
 * @property \App\Model\Entity\Expert $expert
 */
class ExpertInfors extends Entity
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
