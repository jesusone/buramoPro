<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;


/**
 * Fortune Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $user_type
 * @property \Cake\I18n\Time $date_created
 * @property \Cake\I18n\Time $date_modified
 */
class Fortunes extends Entity
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
        '*'      => true,
        'id'     => false,
        'avatar' => true,
        'name'   => true,
    ];

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
