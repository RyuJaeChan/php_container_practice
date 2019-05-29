<?php

namespace wor\lib\database;

use wor\lib\exception\ServerException;
use wor\lib\mvc\Entity;

/**
 * Class SqlExecutor
 *
 * @package wor\lib\database
 */
class SQLExecutor
{
    /**
     * SELECT문을 실행하고 결과 데이터 반환
     *
     * @param string $sql 실행할 SQL문
     * @param string $entityClass 반환 받을 entity 클래스
     * @param array $paramArr SQL에 적용할 파라미터
     *
     * @return array|mixed      1개일경우 object, 여러개일 경우 array로 반환
     * @throws ServerException
     */
    public static function executeQuery(
        string $sql,
        string $entityClass,
        array $paramArr = []
    ) {
        if (!is_subclass_of($entityClass, Entity::class)) {
            throw new ServerException("$entityClass 는 Entity의 자식 클래스가 아닙니다.", 101);
        }

        try {
            $stmt = self::getPreparedState($sql);
            $stmt->execute($paramArr);

            $resultSet = $stmt->fetchAll(\PDO::FETCH_OBJ);

            $ret = array();
            foreach ($resultSet as $row) {
                $entity = new $entityClass;
                foreach ($row as $column => $value) {
                    $entity->setColmValue($column, $value);
                }

                $ret[] = $entity;
            }
        } catch (\Exception $e) {
            $errorMsg = $e->getCode() . " : " . $e->getMessage();
            throw new ServerException($errorMsg, 3);
        }

        return count($ret) == 1 ? array_pop($ret) : $ret;
    }

    /**
     * - DELETE/INSERT/UPDATE문을 실행
     *
     * @param string $sql
     * @param array $paramArr
     *
     * @return int
     * @throws ServerException
     */
    public static function executeUpdate(string $sql, array $paramArr = []): int
    {
        $res = 0;
        try {
            $stmt = self::getPreparedState($sql);
            $res = $stmt->execute($paramArr);

            if ($stmt->errorCode() != "00000") {
                $errorMsg = $stmt->errorCode() . "[" . $stmt->queryString ."] : " . implode(" ", $stmt->errorInfo());
                throw new ServerException($errorMsg, 2);
            }
        } catch (\PDOException $e) {
            $errorMsg = $e->getCode() . " : " . $e->getMessage();
            throw new ServerException($errorMsg, 3);
        }

        return $res;
    }

    /**
     * - DB Connection을 통해 PDOStatement 반환
     *
     * @param string $sql
     *
     * @return \PDOStatement
     */
    private static function getPreparedState(string $sql): \PDOStatement
    {
        $conn = DBConnector::getConnection();
        return $conn->prepare($sql);
    }

}
