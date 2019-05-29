<?php

namespace wor\lib\mvc;

/**
 * Class Entity
 * - 해당 클래스를 상속받은 엔티티 클래스의 멤버 변수는
 *   반드시 carmel case로 작성해야 한다.
 * - 또한 모든 멤버 변수에 대한 getter/setter를 생성해야 한다.
 */
class Entity implements \JsonSerializable
{
    /**
     * - SELECT하여 얻은 row의 값을 Entity의 멤버에 저장
     *
     * @param string $key   row의 column
     * @param string $value row의 value
     *
     * @throws \ReflectionException
     */
    public function setColmValue(string $key, string $value)
    {
        $reflectionClass = new \ReflectionClass($this);
        $reflectionClass
            ->getMethod("set" . self::camelize($key)) //throw error?
            ->invoke($this, $value);
    }

    /**
     * - snake case를 Pascal case 형태로 변환
     *
     * @param string $input     변환할 문자열
     * @param string $separator 구분자
     *
     * @return mixed
     */
    private function camelize($input, $separator = '_')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }

    /**
     * \JsonSerializable 상속 메서드
     *
     * @return array|mixed
     * @throws \ReflectionException
     */
    public function jsonSerialize()
    {
        $reflectionClass = new \ReflectionClass($this);

        $pros = $reflectionClass->getProperties();
        $objectArray = [];
        foreach ($pros as $it) {
            $var = $it->getName();
            $objectArray[$var] = $reflectionClass
                ->getMethod("get" . self::camelize($var))
                ->invoke($this);
        }

        return $objectArray;
    }

}