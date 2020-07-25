<?php

declare(strict_types=1);
namespace AlgoWeb\ODataMetadata\Tests\Northwind\Facets;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Library\Core\EdmCoreModel;
use AlgoWeb\ODataMetadata\Library\EdmEntityType;
use AlgoWeb\ODataMetadata\Library\EdmStructuralProperty;

class Structure
{
    public static function getCustomers($namespace = 'Northwind')
    {
        $entityType    = new EdmEntityType($namespace, 'customer');
        $id            = new EdmStructuralProperty($entityType, 'id', EdmCoreModel::getInstance()->getInt32(false));
        $company       = new EdmStructuralProperty($entityType, 'company', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $lastName      = new EdmStructuralProperty($entityType, 'last_name', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $emailAddress  = new EdmStructuralProperty($entityType, 'email_address', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $jobTitle      = new EdmStructuralProperty($entityType, 'job_title', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $businessPhone = new EdmStructuralProperty($entityType, 'business_phone', EdmCoreModel::getInstance()->getString(false, 25, false, null, null, true));
        $homePhone     = new EdmStructuralProperty($entityType, 'home_phone', EdmCoreModel::getInstance()->getString(false, 25, false, null, null, true));
        $mobilePhone   = new EdmStructuralProperty($entityType, 'mobile_phone', EdmCoreModel::getInstance()->getString(false, 25, false, null, null, true));
        $faxNumber     = new EdmStructuralProperty($entityType, 'fax_number', EdmCoreModel::getInstance()->getString(false, 25, false, null, null, true));
        $address       = new EdmStructuralProperty($entityType, 'address', EdmCoreModel::getInstance()->getString(true, null, null, null, null, true));
        $city          = new EdmStructuralProperty($entityType, 'city', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $stateProvince = new EdmStructuralProperty($entityType, 'state_province', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $zipPostalCode = new EdmStructuralProperty($entityType, 'zip_postal_code', EdmCoreModel::getInstance()->getString(false, 15, false, null, null, true));
        $countryRegion = new EdmStructuralProperty($entityType, 'country_region', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $webPage       = new EdmStructuralProperty($entityType, 'web_page', EdmCoreModel::getInstance()->getString(true, null, null, null, null, true));
        $notes         = new EdmStructuralProperty($entityType, 'notes', EdmCoreModel::getInstance()->getString(true, null, null, null, null, true));
        $attachments   = new EdmStructuralProperty($entityType, 'attachments', EdmCoreModel::getInstance()->getBinary(true, null, null, true));
        $entityType->addProperty($id);
        $entityType->addProperty($company);
        $entityType->addProperty($lastName);
        $entityType->addProperty($emailAddress);
        $entityType->addProperty($jobTitle);
        $entityType->addProperty($businessPhone);
        $entityType->addProperty($homePhone);
        $entityType->addProperty($mobilePhone);
        $entityType->addProperty($faxNumber);
        $entityType->addProperty($address);
        $entityType->addProperty($city);
        $entityType->addProperty($stateProvince);
        $entityType->addProperty($zipPostalCode);
        $entityType->addProperty($countryRegion);
        $entityType->addProperty($webPage);
        $entityType->addProperty($notes);
        $entityType->addProperty($attachments);
        return ['Customer' => $entityType];
    }

    public static function getEmployeePrivileges($namespace = 'Northwind')
    {
        $entityType = new EdmEntityType($namespace, 'EmployeePrivilege');
        $entityType->addStructuralProperty('employee_id', PrimitiveTypeKind::Int32(), false);
        $entityType->addStructuralProperty('privilege_id', PrimitiveTypeKind::Int32(), false);
        return ['EmployeePrivileges' => $entityType];
    }

    public static function getEmployees($namespace = 'Northwind')
    {
        $entityType    = new EdmEntityType($namespace, 'Employee');
        $id            = new EdmStructuralProperty($entityType, 'id', EdmCoreModel::getInstance()->getInt32(false));
        $company       = new EdmStructuralProperty($entityType, 'company', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $lastName      = new EdmStructuralProperty($entityType, 'last_name', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $emailAddress  = new EdmStructuralProperty($entityType, 'email_address', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $jobTitle      = new EdmStructuralProperty($entityType, 'job_title', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $businessPhone = new EdmStructuralProperty($entityType, 'business_phone', EdmCoreModel::getInstance()->getString(false, 25, false, null, null, true));
        $homePhone     = new EdmStructuralProperty($entityType, 'home_phone', EdmCoreModel::getInstance()->getString(false, 25, false, null, null, true));
        $mobilePhone   = new EdmStructuralProperty($entityType, 'mobile_phone', EdmCoreModel::getInstance()->getString(false, 25, false, null, null, true));
        $faxNumber     = new EdmStructuralProperty($entityType, 'fax_number', EdmCoreModel::getInstance()->getString(false, 25, false, null, null, true));
        $address       = new EdmStructuralProperty($entityType, 'address', EdmCoreModel::getInstance()->getString(true, null, null, null, null, true));
        $city          = new EdmStructuralProperty($entityType, 'city', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $stateProvince = new EdmStructuralProperty($entityType, 'state_province', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $zipPostalCode = new EdmStructuralProperty($entityType, 'zip_postal_code', EdmCoreModel::getInstance()->getString(false, 15, false, null, null, true));
        $countryRegion = new EdmStructuralProperty($entityType, 'country_region', EdmCoreModel::getInstance()->getString(false, 50, false, null, null, true));
        $webPage       = new EdmStructuralProperty($entityType, 'web_page', EdmCoreModel::getInstance()->getString(true, null, null, null, null, true));
        $notes         = new EdmStructuralProperty($entityType, 'notes', EdmCoreModel::getInstance()->getString(true, null, null, null, null, true));
        $attachments   = new EdmStructuralProperty($entityType, 'attachments', EdmCoreModel::getInstance()->getBinary(true, null, null, true));
        $entityType->addProperty($id);
        $entityType->addProperty($company);
        $entityType->addProperty($lastName);
        $entityType->addProperty($emailAddress);
        $entityType->addProperty($jobTitle);
        $entityType->addProperty($businessPhone);
        $entityType->addProperty($homePhone);
        $entityType->addProperty($mobilePhone);
        $entityType->addProperty($faxNumber);
        $entityType->addProperty($address);
        $entityType->addProperty($city);
        $entityType->addProperty($stateProvince);
        $entityType->addProperty($zipPostalCode);
        $entityType->addProperty($countryRegion);
        $entityType->addProperty($webPage);
        $entityType->addProperty($notes);
        $entityType->addProperty($attachments);
        return ['Employees' => $entityType];
    }
}
