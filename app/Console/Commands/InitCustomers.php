<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use App\Importer;
use App\Entities\Customer;
use Doctrine\ORM\EntityManager as ORM;
use Doctrine\ORM\EntityManagerInterface;
 
class InitCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:customers';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and store customersd data';

    protected $em;
 
    public function handle(ORM $em)
    {
        $this->em = $em;        

        $this->info('Fetch customers..');

        $importer = new Importer('AU', 100);
        $customers = $importer->fetch()->get();

        foreach($customers['results'] as $customer) {
            $query = $this->em->createQuery('SELECT u FROM App\Entities\Customer u WHERE u.email = :email');
            $query->setParameters(array(
                'email' => $customer['email']
            ));
            $cs = $query->getOneOrNullResult();

            if(!$cs) {
                $a = new Customer(
                    $customer['email'],
                    $customer['login']['username'],
                    md5($customer['login']['password']),
                    $customer['name']['first'], 
                    $customer['name']['last'],
                    $customer['gender'],
                    $customer['location']['country'],
                    $customer['location']['city'],
                    $customer['phone']
                );
                $this->em->persist($a);
                $this->em->flush();

                $this->info($customer['name']['first'] .' '. $customer['name']['last'] . '- Added');
            } else {
                $query = $this->em->createQuery("UPDATE MyProject\Model\User u SET 
                    u.username = '".$customer['login']['username']."', 
                    u.password = '".md5($customer['login']['password'])."', 
                    u.firstname = '".$customer['name']['first']."', 
                    u.lastname = '".$customer['name']['last']."', 
                    u.gender = '".$customer['gender']."', 
                    u.country = '".$customer['location']['country']."', 
                    u.city = '".$customer['location']['city']."', 
                    u.phone = '".$customer['phone']."'
                    WHERE u.id = ".$cs->getId()."
                    ");

                $this->line($customer['name']['first'] .' '. $customer['name']['last'] . '- Updated');
                
            }
        }
    }
}