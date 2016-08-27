<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserCoinPayment Entity
 *
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property int $coin
 * @property string $transaction_id
 * @property string $transaction_type
 * @property int $coin_type
 * @property int $status
 * @property bool $delete_flg
 * @property \Cake\I18n\Time $date_created
 * @property \Cake\I18n\Time $date_modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Transaction $transaction
 */
class UserCoinPayment extends Entity
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
