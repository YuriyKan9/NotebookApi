<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 *
 * @OA\Schema(
 * required={"ФИО","Телефон","Email"},
 * @OA\Xml(name="Notebook"),
 * )
 *
 */
class Notebook extends Model
{
    use HasFactory;
    /**
     * @OA\Property(
     *      title="ФИО",
     *      description="User Name",
     *      example="Юрий Канительщиков"
     * )
     *
     * @var string
     */
    public $ФИО;
        /**
     * @OA\Property(
     *      title="Компания",
     *      description="Название компании",
     *      example="Nestle"
     * )
     *
     * @var string
     */
    public $Компания;
       /**
     * @OA\Property(
     *      title="Телефон",
     *      description="Телефон пользователя",
     *      example="8-901-283-40-30"
     * )
     *
     * @var string
     */
    public $Телефон;
         /**
     * @OA\Property(
     *      title="Email",
     *      description="email пользователя",
     *      example="kanitely@icloud.com"
     * )
     *
     * @var string
     */
    public $Email;
        /**
     * @OA\Property(
     *      title="Дата_рождения",
     *      description="Дата рождения пользователя",
     *      example="21-10-1999"
     * )
     *
     * @var string
     */
    public $Дата_рождения;
    /**
     * @OA\Property(
     *      title="Фото",
     *      description="Ваше фото",
     *      example="hello.jpg"
     * )
     *
     * @var string
     */
    public $Фото;
    
    protected $fillable = [
        'ФИО',
        'Компания',
        'Телефон',
        'Email',
        'Дата_рождения',
        'Фото'
    ];
}