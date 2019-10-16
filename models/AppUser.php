<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_user".
 *
 * @property int $id
 * @property int $id_pegawai
 * @property int $id_group
 * @property string $username
 * @property string $password
 * @property int $superuser
 * @property int $status
 * @property int $access_delete
 * @property int $id_user
 * @property string $last_ip
 * @property string $last_activity
 *
 * @property AppUserGroup $group
 * @property AppUserAkse[] $appUserAkses
 * @property AppUserGdokter[] $appUserGdokters
 * @property AppUserIp[] $appUserIps
 */
class AppUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pegawai', 'id_group', 'superuser', 'status', 'access_delete', 'id_user'], 'integer'],
            [['id_group', 'username', 'password'], 'required'],
            [['last_activity'], 'safe'],
            [['username', 'password'], 'string', 'max' => 45],
            [['last_ip'], 'string', 'max' => 100],
            [['id_group'], 'exist', 'skipOnError' => true, 'targetClass' => AppUserGroup::className(), 'targetAttribute' => ['id_group' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_pegawai' => Yii::t('app', 'Id Pegawai'),
            'id_group' => Yii::t('app', 'Id Group'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'superuser' => Yii::t('app', 'Superuser'),
            'status' => Yii::t('app', 'Status'),
            'access_delete' => Yii::t('app', 'Access Delete'),
            'id_user' => Yii::t('app', 'Id User'),
            'last_ip' => Yii::t('app', 'Last Ip'),
            'last_activity' => Yii::t('app', 'Last Activity'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(AppUserGroup::className(), ['id' => 'id_group']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppUserAkses()
    {
        return $this->hasMany(AppUserAkse::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppUserGdokters()
    {
        return $this->hasMany(AppUserGdokter::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppUserIps()
    {
        return $this->hasMany(AppUserIp::className(), ['id_user' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
       
        return AppUser::findOne($id);
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

     /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
       
        return AppUser::findOne(['username'=>$username]);
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }*/

        //return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

     /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        return AppUser::findOne(['accessToken'=>$token]);
    }
}
