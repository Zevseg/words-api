<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vocabulary".
 *
 * @property int $vocabulary_id
 * @property string $vocab
 */
class Vocabulary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vocabulary';
    }

    /**
     * 
     * @param string $word
     * @return string
     */
    public static function clear($word) {
        $word = trim($word);
        $word = strip_tags($word);
        $word = stripslashes($word);
        $word = htmlspecialchars($word);
        $word = preg_replace('/[^а-яА-ЯёЁ]/ui', '', $word);
        
        return $word;
    }
    
    public static function getNameWords($count_words = 0) {
        $name_words = 'слов';
        if (in_array($count_words, [1,21,31,41,51,61,71,81,91])) { 
            $name_words = 'слово';
        } elseif (in_array($count_words, [22,23,24,32,33,34,42,43,44,52,53,54,62,63,64,72,73,74,82,83,84,91,92,93,94])) { 
            $name_words = 'слова'; 
        }
        
        return $name_words;
    }
}
