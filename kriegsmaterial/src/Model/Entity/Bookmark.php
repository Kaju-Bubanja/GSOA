<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Collection\Collection;

/**
 * Bookmark Entity.
 */
class Bookmark extends Entity
{

    protected function _getTagString(){
        if(isset($this->_properties['tag_string'])){
            return $this->_properties['tag_string'];
        }
        if(empty($this->tags)){
            return '';
        }
        $tags = new Collection($this->tags);
        $str = $tags->reduce(function ($string, $tag){
            return $string . $tag->title . ', ';
        }, '');
        return trim($str, ', ');
    }

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'title' => true,
        'description' => true,
        'url' => true,
        'user' => true,
        'tags' => true,
        'tag_string' => true,
    ];
}
