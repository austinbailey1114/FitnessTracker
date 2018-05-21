<?php

namespace Carbon\Controllers;
use Illuminate\Database\QueryException;
use Carbon\Models\User;
use Carbon\Models\LiftType;
use Carbon\Models\FoodGoal;
use Carbon\Models\Lift;
use Carbon\Models\Bodyweight;

class APIController extends Controller {
    public function postAuth($request, $response) {
        $username = $request->getParam('username');
        $password = $request->getParam('password');

        $user = User::where('username', $username)->first();

        if (!$user) {
            $data = [
                'success' => false,
                'message' => 'User with that username does not exist',
            ];
            return $response->withJson($data);
        }

        if (password_verify($password, $user->password)) {
            $key = md5($username . $password . time());
            $data = [
                'success' => true,
                'key' => $key,
                'id' => $user->id
            ];
            $user->update([
                'exchange_code' => $key,
            ]);
        } else {
            $data = [
                'success' => false,
                'message' => 'Password did not match',
            ];
        }
        return $response->withJson($data);
    }

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

    public function deleteBodyweight($request, $response) {
        try {
            Bodyweight::where('id', $request->getParam('id'))->delete();
            return $response->withStatus(200);
        } catch(QueryException $e) {
            return $response->withStatus(400);
        }
    }

    public function getLifttypes($request, $response, $args) {
        $lifttypes = LiftType::where('user', $args['id'])->get();

        return $response->withJson($lifttypes);
    }

    public function getFoodGoals($request, $response, $args) {
        $goals = FoodGoal::where('user', $args['id'])->first();

        if (!$goals) {
            $goals = FoodGoal::create([
                'user' => $args['id'],
                'calories' => 2000,
                'fat' => 50,
                'carbohydrate' => 40,
                'protein' => 30,
            ]);
        }

        return $response->withJson($goals);
    }

    public function postFoodGoals($request, $response) {
        FoodGoal::where('user', $request->getParam('id'))->update([
            'calories' => $request->getParam('cals'),
            'fat' => $request->getParam('fat'),
            'carbohydrate' => $request->getParam('carbs'),
            'protein' => $request->getParam('protein'),
        ]);
    }
}

?>
