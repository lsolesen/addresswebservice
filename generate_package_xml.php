<?php
/**
 * package.xml generation script
 * @package Services_AddressWebService
 * @author  Lars Olesen <lars@legestue.net>
 * @since   0.1.0
 * @version 0.1.0
 */

require_once 'PEAR/PackageFileManager2.php';
PEAR::setErrorHandling(PEAR_ERROR_DIE);
$pfm = new PEAR_PackageFileManager2();
$pfm->setOptions(
    array(
        'baseinstalldir'    => 'Services/AddressWebService',
        'filelistgenerator' => 'file',
        'packagedirectory'  => dirname(__FILE__),
        'packagefile'       => 'package.xml',
        'ignore'            => array(
			'generate_package_xml.php',
			'package.xml',
			'*.tgz'
			),
		'exceptions'        => array(),
        'simpleoutput'      => true,
	)
);

$pfm->setPackage('Services_AddressWebService');
$pfm->setSummary('Communicates with AWS');
$pfm->setDescription('Needs to be filled in');
$pfm->setUri('http://localhost');
$pfm->setLicense('BSD license', 'http://www.opensource.org/licenses/bsd-license.php');
$pfm->addMaintainer('lead', 'lsolesen', 'Lars Olesen', 'lars@legestue.net');

$pfm->setPackageType('php');

$pfm->setAPIVersion('0.1.0');
$pfm->setReleaseVersion('0.1.0');
$pfm->setAPIStability('alpha');
$pfm->setReleaseStability('alpha');
$pfm->setNotes('Needs to be filled in');
$pfm->addRelease();

$pfm->addGlobalReplacement('package-info', '@package-version@', 'version');

$pfm->clearDeps();
$pfm->setPhpDep('4.3.0');
$pfm->setPearinstallerDep('1.5.0');
$pfm->addPackageDepWithUri('required', 'nusoap', 'http://svn.intraface.dk/intrafacepublic/3Party/nusoap/nusoap-0.7.2');

$pfm->generateContents();

if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
	echo 'write package file';
    $pfm->writePackageFile();
} else {
	echo 'debug package file';
    $pfm->debugPackageFile();
}
?>