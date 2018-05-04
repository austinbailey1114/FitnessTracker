<?php

namespace Carbon\Controllers;
use Carbon\Models\Lift;
use Carbon\Models\Bodyweight;
use Illuminate\Database\QueryException;

class APIController extends Controller {
    public function getLift($request, $response, $args) {
        $lifts = Lift::where('user', $args['id'])->get();

        return $response->withJson($lifts);
    }

    public function postLift($request, $response) {

        if ($request->getParam('date') == "") {
			$date = strtotime('today midnight');
		} else {
			$date = strtotime($request->getParam('date'));
		}

		$date = date("Y-m-d H:i:s", $date);

        try {
            $created = Lift::create([
                'weight' => $request->getParam('weight'),
                'reps' => $request->getParam('reps'),
                'date' => $date,
                'type' => $request->getParam('type'),
                'user' => $request->getParam('user'),
            ]);

            return $response->withStatus(201);

        } catch(QueryException $e) {
            return $response->withStatus(400);
        }
    }

    public function deleteLift($request, $response) {
        try {
            Lift::where('id', $request->getParam('id'))->delete();

            return $response->withStatus(201);
        } catch(\Illuminate\Database\QueryException $e) {
            return $response->withStatus(400);
        }
    }

    public function getBodyweight($request, $response, $args) {
        $bodyweights = Bodyweight::where('user', $args['id'])->get();

        return $response->withJson($bodyweights);
    }

    public function postBodyweight($request, $response) {

        $date = strtotime('today midnight');
		$date = date("Y-m-d H:i:s", $date);

        try {
            Bodyweight::create([
                'user' => $request->getParam('user'),
                'weight' => $request->getParam('weight'),
                'date' => $date,
            ]);

            return $response->withStatus(200);
        } catch(QueryException $e) {
            return $response->withStatus(400);
        }
    }
}

?>
