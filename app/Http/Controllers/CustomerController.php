<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use Doctrine\ORM\EntityManager as ORM;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $em;

    public function __construct(ORM $em)
    {
        $this->em = $em;
    }

    public function listAll() {
        $query = $this->em->createQuery("SELECT concat(u.firstname, ' ', u.lastname) as fullname, u.email, u.country FROM App\Entities\Customer u");
        $cs = $query->getArrayResult();
        return response()->json($cs);
            
    }

    public function listOne($id) {
        $query = $this->em->createQuery("SELECT concat(u.firstname, ' ', u.lastname) as fullname, u.email, u.username, u.gender, u.country, u.city, u.phone FROM App\Entities\Customer u WHERE u.id = :id");
        $query->setParameters(array(
            'id' => $id
        ));
        $cs = $query->getArrayResult();
        return response()->json($cs);
    }

    //
}
