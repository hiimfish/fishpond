<?php

namespace Gamesmkt\Fishpond;

use DateTime;
use Gamesmkt\Fishpond\Config;
use Gamesmkt\Fishpond\GameInterface;
use Gamesmkt\Fishpond\PlayerInterface;
use Gamesmkt\Fishpond\RecordInterface;
use Gamesmkt\Fishpond\TransactionInterface;
use Gamesmkt\Fishpond\TypeInterface;

/**
 * TODO: Adatper 的 Record 都要完成正規化。
 */
interface AdapterInterface
{
    /**
     * 準備建立玩家。
     *
     * （通常是因為該服務有特定的帳號規則，或是想要自定義玩家帳號、暱稱。）
     *
     * @param \Gamesmkt\Fishpond\PlayerInterface $player
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return array|false false on failure, meta data on success
     */
    public function prepareCreatePlayer(PlayerInterface $player, Config $config);

    /**
     * 建立玩家。
     *
     * @param \Gamesmkt\Fishpond\PlayerInterface $player
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return array|false false on failure, meta data on success
     */
    public function createPlayer(PlayerInterface $player, Config $config);

    /**
     * 取得登入網址。
     *
     * Conifg
     * - device:
     *   (string) pc or mobile.
     *
     * @param \Gamesmkt\Fishpond\PlayerInterface $player
     * @param \Gamesmkt\Fishpond\GameInterface $game
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return array|false false on failure, meta data on success
     */
    public function getLoginUrl(PlayerInterface $player, GameInterface $game, Config $config);

    /**
     * 登出玩家。
     *
     * @param \Gamesmkt\Fishpond\PlayerInterface $player
     * @param \Gamesmkt\Fishpond\GameInterface $game
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return bool
     */
    public function logout(PlayerInterface $player, GameInterface $game, Config $config);

    /**
     * 取得玩家餘額。
     *
     * @param \Gamesmkt\Fishpond\PlayerInterface $player
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return array|false false on failure, meta data on success
     */
    public function getBalance(PlayerInterface $player, Config $config);

    /**
     * 準備執行交易。
     *
     * 通常是因為該服務有特定的流水號規則。
     *
     * @param \Gamesmkt\Fishpond\TransactionInterface $player
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return array|false false on failure, meta data on success
     */
    public function prepareTransfer(TransactionInterface $transaction, Config $config);

    /**
     * 執行交易。
     *
     * @param \Gamesmkt\Fishpond\TransactionInterface $player
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return array|false false on failure, meta data on success
     */
    public function transfer(TransactionInterface $transaction, Config $config);

    /**
     * 查詢玩家轉帳紀錄
     *
     * @param \Gamesmkt\Fishpond\TransactionInterface $player
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return array|false false on failure, meta data on success
     */
    public function getTransferRecord(TransactionInterface $transaction, Config $config);

    /**
     * 透過時間抓取紀錄。
     *
     * @param \Gamesmkt\Fishpond\TypeInterface $type
     * @param \DateTime $start
     * @param \DateTime $end
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return array|false false on failure, meta data on success
     */
    public function fetchRecords(TypeInterface $type, DateTime $start, DateTime $end, Config $config);

    /**
     * 透過上下文抓取紀錄。
     *
     * @param \Gamesmkt\Fishpond\TypeInterface $type
     * @param string $context
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return array|false false on failure, meta data on success
     */
    public function fetchRecordsByContext(TypeInterface $type, string $context, Config $config);

    /**
     * 直接抓取未被標記的紀錄，並藉由傳遞清單來標記已抓取的紀錄。
     *
     * @param \Gamesmkt\Fishpond\TypeInterface $type
     * @param array $listCompleteRecord
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return array|false false on failure, meta data on success
     */
    public function fetchRecordsByDirectWithMark(TypeInterface $type, array $listCompleteRecord, Config $config);

    /**
     * 取得詳細紀錄的網址。
     *
     * @param \Gamesmkt\Fishpond\RecordInterface $record
     * @param \Gamesmkt\Fishpond\GameInterface $game
     * @param \Gamesmkt\Fishpond\Config $config
     *
     * @return array|false false on failure, meta data on success
     */
    public function getRecordDetailUrl(RecordInterface $record, GameInterface $game, Config $config);

}