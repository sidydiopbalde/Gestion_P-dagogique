<?php
namespace Core;
// use App\Core\Validator\Validator1;


class Controller implements ControllerInterface {
    protected $validator;
    protected $Session;
    public function __construct(SessionInterface $Session){
      
        $this->Session=$Session;
        if($this->Session){
            $this->Session->start();
        }
    }
    
    /**
     * Renders a view file.
     *
     * @param string 
     * @param array 
     */
    public function renderView(string $view, array $data = []) {
        // Extract the data array to variables
        extract($data);

        // Generate the path to the view file
        $viewPath ="/var/www/html/Gestion_Pedagogique/views/$view.php";

       
        if (file_exists($viewPath)) {
       
            require $viewPath;
        } else {
           
            echo "View not found: $viewPath";
        }
    }

    /**
     * Redirects to another URL.
     *
     * @param string $url The URL to redirect to.
     */
    public function redirect(string $url) {
        // Send the HTTP header to redirect
        header("Location: $url");
        exit;
    }
}
?>
