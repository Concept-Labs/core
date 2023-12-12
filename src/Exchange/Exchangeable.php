<?php
namespace Cl\Exchange;

trait Exchangeable {

    const CLE_STATUS_FAILED = '-2';
    const CLE_STATUS_STOPPED = '-1';
    const CLE_STATUS_INIT = 0;
    const CLE_STATUS_PENDING = '1';
    const CLE_STATUS_RECEIVED = '2';
    protected $cle_status = self::CLE_STATUS_INIT;

    public function yeld_fn()
    {
        $i=0;
        yield;
        while (true) {
            $i++;
            yield "hello from yield {$i}";
            sleep(2);
            echon("received in yeld");
        }
    }
    protected function cle_socket()
    {
        $i=0;
        while(
            static::CLE_STATUS_INIT <= $this->cle_getStatus()
        ){
            
            if(static::CLE_STATUS_INIT == $this->cle_getStatus()){
                $this->cle_setStatus(static::CLE_STATUS_PENDING);
                yield "init";
            }
            var_dump('read incoming');
            $incoming = yield 'response';
            var_dump($incoming->r);
            $incoming->run();
            
        }
    }

    public function cle_send($packet)
    {
        $res = $this->cle_socket()->send($packet);
         return $res;
    }

    public function cle_getStatus()
    {
        return $this->cle_status;
    }

    public function cle_setStatus(int $status)
    {
        $this->cle_status = $status;
        return $this;
    }

}
