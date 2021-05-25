<?php
class Mysql
    {
        public $sql_serveur;
        public $sql_utlisateur;
        public $sql_password;
        public $sql_bd;
        public $connection_sql;
        public $select_bd;
        public $resultat;
        public $sql_debug;
        public $connection_verif;
        public $nb_requete;
        public $erreur;
        public $message_erreur;
         
        //constructeur PHP5
        public function __construct($serveur, $utlisateur, $password, $bd, $debug, $erreur)
            {
                $this->sql_serveur = $serveur;
                $this->sql_utilisateur = $utlisateur;
                $this->sql_password = $password;
                $this->sql_bd = $bd;
                $this->sql_debug = $debug;
                $this->message_erreur = $erreur;
                $this->resultat = array();
                $this->connection_verif = 0;
                $this->connection();
            }
                 
        //fonction de connection a mysql
        function connection()
            {
                if($this->connection_verif == "0")
                    {
                        $this->connection_sql = mysqli_connect($this->sql_serveur, $this->sql_utilisateur, $this->sql_password);
                        if(!$this->connection_sql)
                            {
                                $this->mysql_erreur();
                            }
                        else
                            {
                                $this->selection_bd();
                            }
                    }
            }
         
        //fonction de selection de la base de donnée
        function selection_bd()
            {
                $this->select_bd = mysqli_select_db($this->connection_sql,$this->sql_bd);  
                if(!$this->select_bd) 
                    { 
                        $this->mysql_erreur(); 
                    }
                else
                    {
                        $this->connection_verif = 1;
                    }
            }
         
        //fonction de déconnexion de la base de donnée
        function deconnexion()
            {
                mysqli_close($this->connection_sql);
            }
             
        //fonction d'execution de requête
        function requete($requete, $p)
            {
                $this->resultat[$p] = mysqli_query($this->connection_sql,$requete);
                $this->nb_requete++;
                if(!$this->resultat[$p])
                    {
                        $this->mysql_erreur();
                    }
            }
         
        //fontion qui retourne les donnée dans un tableau grace a fetch array
        function resultat($p)
            {
                return @mysqli_fetch_array($this->resultat[$p]);
            }
         
        //fonction permettant de compter le nombre de resultat trouvé
        function nb_resultat($p)
            {
                return @mysqli_num_rows($this->resultat[$p]);
            }
        //function d'affichage des erreur mysql 
        function mysql_erreur()
            {
                if($this->sql_debug == 0)
                    {
                        echo $this->message_erreur;
                    }
                elseif($this->sql_debug == 1)
                    {
                        $this->erreur = @mysqli_error($this->connection_sql); 
                        $message = "une erreur mysql est survenue : <br /> <form name='mysql'><textarea rows='15' cols='60'>".$this->erreur."</textarea></form>";
                        echo $message;
                    }
            }
    }
?>