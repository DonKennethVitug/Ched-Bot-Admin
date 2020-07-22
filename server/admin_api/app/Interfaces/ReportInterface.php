<?php

namespace Interfaces;

interface ReportInterface{

	public function getReports();

	public function getNearbyReports($args);

	public function getOtherReports($args);

	public function addReport($request);

}