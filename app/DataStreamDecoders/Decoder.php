<?php

namespace App\DataStreamDecoders;

/**
 * Decoder interface for DataStreamDecoders classes
 * @package App\DataStreamDecoders
 */
interface Decoder
{
	public function decode();
}