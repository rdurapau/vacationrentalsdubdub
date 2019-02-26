<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Response;
// use League\Fractal\Manager;

class ApiController extends Controller
{
	protected $statusCode = 200;

	public function __construct()
	{
		$this->middleware('api');
		// $this->fractal = new Manager();
		// if (isset($_GET['include'])) {
		// 	$this->fractal->parseIncludes($_GET['include']);
		// }
		// if (isset($_GET['exclude'])) {
		// 	$this->fractal->parseExcludes($_GET['exclude']);
		// }
	}

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	public function respondNotFound($message = 'Not found!')
	{
		$this->setStatusCode(404);
		return $this->respondWithError($message);
	}

	public function respondNoContent()
	{
		return Response::json([], 204);
	}

	public function respond($data, $headers = [])
	{
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	public function respondWithError($message)
	{
		return $this->respond([
			'error' => [
				'message' => $message,
				'status_code' => $this->getStatusCode()
			]
		]);
	}


}
