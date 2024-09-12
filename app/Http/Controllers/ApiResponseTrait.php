<?php

namespace App\Http\Controllers;


trait ApiResponseTrait
{

    /*
     * [
     * data => data ,
     * status=> true or false
     * error = > 'Error Massage'
     * ]
     */

    public function apiResponse($data = null, bool $status = true, $error = null, $statusCode = 200)
    {

        $array = [
            'data' => $data,
            'status' => $status,
            'error' => $error,
            'statusCode' => $statusCode
        ];
        return response($array);
    }

    public function unAuthoriseResponse()
    {
        return $this->apiResponse(null, 0, ['Unauthorized' => ['Unauthorized !']], 401);
    }

    public function loginResponse()
    {
        return $this->apiResponse(null, 0, ['Unauthorized' => ['you should login first']], 401);
    }


    public function acceptHeader()
    {
        return $this->apiResponse(
            null,
            0,
            ['accept_header' => ['You should add Accept key in the header request, and the value of Accept key MUST be equal to application/json !']],
            401
        );
    }

    public function NotCraftMan()
    {
        return $this->apiResponse(null, 0, ['Unauthorized !' => ['Only craft man can use this request !']], 401);
    }

    public function errorApiResponse($key, $value)
    {
        if (is_array($value)) {
            return $this->apiResponse(null, 0, [$key => $value], 422);
        }
        return $this->apiResponse(null, 0, [$key => [$value]], 422);
    }

    public function notAdmin()
    {
        return $this->apiResponse(null, 0, ['Unauthorized !' => ['Only Admin can use this request !']], 401);
    }

    public function notFound()
    {
        return $this->apiResponse(null, 0, ["the item not found"], 404);
    }

    public function notAllow()
    {
        return $this->apiResponse(null, 0, ["this account don't have this permission"], 403);
    }

    public function IncorrectAccountType()
    {
        return $this->apiResponse(null, 0, ["This data is not available for this type of account"], 403);
    }

}

