<?php
class AppException extends Exception
{
}

class ValidationException extends AppException
{

}

class RecordNotFoundException extends AppException
{

}
class UserExistsException extends AppException
{

}