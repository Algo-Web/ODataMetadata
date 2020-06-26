<?php


namespace AlgoWeb\ODataMetadata\Util;


use AlgoWeb\ODataMetadata\Exception\ArgumentException;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;

class UnmanagedByteArray implements \ArrayAccess, \IteratorAggregate, \Countable
{
    private $memoryStream;
    private $length;
    private $readonly;

    public function __construct(&$stream, $readonly = true)
    {
        assert(is_resource($stream));
        $stat = fstat($stream);
        $this->length = $stat['size'];
        $this->readonly = $readonly;
        $this->memoryStream = $stream;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        rewind($this->memoryStream);
        while(false !== $char = fgetc($this->memoryStream)){
            yield ord($char);
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return is_int($offset) && 0 <= $offset  && $offset < $this->length;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        if(!$this->offsetExists($offset)){
            throw new ArgumentException(sprintf('%s is out of range', $offset));
        }
        fseek($this->memoryStream, $offset);
        return ord(fgetc($this->memoryStream));
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        if(!is_int($value) || $value <0 || $value > 255){
            throw new \InvalidArgumentException(sprintf('%s is an invalid value for a ByteArray', $value));
        }
        if($this->readonly){
            throw new InvalidOperationException('attempt to write to read only array');
        }
        if($offset !== null || $offset < 0 || $offset > $this->length ){
            throw new \InvalidArgumentException('allowable offsets are between 0 and full legnth or null');
        }
        if(null === $offset){
            fseek($this->memoryStream, 0, SEEK_END);
        }else {
            fseek($this->memoryStream, $offset);
        }
        fwrite($this->memoryStream, chr($value));
        $stat = fstat($this->memoryStream);
        $this->length = $stat['size'];
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        throw new InvalidOperationException('items can not be unset in an unmanaged array');
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return $this->length;
    }
}