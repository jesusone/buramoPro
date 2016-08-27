<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property bool $published
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $updated
 * @property int $lft
 * @property int $rght
 *
 * @property \App\Model\Entity\ParentCategory $parent_brm_category
 * @property \App\Model\Entity\ChildCategory[] $child_brm_categories
 */
class Category extends Entity
{
    var $name = 'Category';
    var $actsAs = array('Tree');

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
