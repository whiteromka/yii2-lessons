<?php

namespace app\models;

use app\components\UserPassportCreator;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property int $gender
 * @property string $password_hash
 * @property int $status_id
 * @property string $breed
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Status $status
 * @property Car $car
 * @property Passport $passport
 */
class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_LOGIN = 'login';
    const SCENARIO_DEFAULT = 'default';

    /** @var string - пол мужской */
    public const GENDER_MALE = 'М';

    /** @var string - пол женский */
    public const GENDER_FEMALE = 'Ж';

    public const STATUS_ACTIVE = 'active';
    public const STATUS_DISACTIVE = 'disactive';

    public string $password = '';

    public string $password_repeat = '';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_LOGIN => ['email', 'password'],
            self::SCENARIO_DEFAULT => ['email',
                'password',
                'last_name',
                'status_id',
                'password_hash',
                'password_repeat',
                'gender',
                'name',
                'created_at', 'updated_at'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 60],
            [['last_name'], 'string', 'max' => 60],
            [['password_hash'], 'string', 'max' => 100],
            [['name', 'last_name', 'email', 'password_hash', 'status_id'], 'required'],
            [['status_id', 'car_id'], 'integer'],
            [['gender'], 'integer'],
            ['gender', 'in', 'range' => [0, 1]],
            [['email'], 'email'],
            [['email'], 'unique', 'on' => self::SCENARIO_DEFAULT],
            [['created_at', 'updated_at'], 'safe'],
            [['password_repeat', 'password'], 'required'],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'password_hash' => 'Хэш пароля',
            'status_id' => 'Статус ID',
            'email' => 'email',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'gender' => 'Пол'
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    public function getCar()
    {
        return $this->hasOne(Car::class, ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPassport()
    {
        return $this->hasOne(Passport::class, ['user_id' => 'id']);
    }

    public static function getGenders(): array
    {
        return [
            0 => User::GENDER_FEMALE,
            1 => User::GENDER_MALE
        ];
    }

    public static function getGendersWithEmpty(): array
    {
        return [
            null => '',
            0 => User::GENDER_FEMALE,
            1 => User::GENDER_MALE
        ];
    }

    public function getGenderChar(): string
    {
        $genders = self::getGendersWithEmpty();
        return $genders[$this->gender];
    }

    /**
     * Получить все возможные статусы
     */
    public static function getStatuses(): array
    {
        return [
            1 => User::STATUS_ACTIVE ,
            2 => User::STATUS_DISACTIVE,
            3 => 'Old',
            4 => 'Old2'
        ];
    }

    public function getStatusAsString(): string
    {
        $allStatuses = self::getStatuses();
        return $allStatuses[$this->status_id];
    }

    public function generatePasswordHash(string $password): string
    {
        return sha1($password); // !
//        return Yii::$app
//            ->getSecurity()
//            ->generatePasswordHash($password, UserPassportCreator::DIFICULTY_PASSWORD);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return self::findOne(['access_token' => $token]);
        return '';
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        // return $this->auth_key;
        return '';
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        // return $this->getAuthKey() === $authKey;
        return true;
    }
}
