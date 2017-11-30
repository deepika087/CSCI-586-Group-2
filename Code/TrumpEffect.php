
  <?php
        // customize your ARC2 location
             include_once("C:/Apache24/htdocs/CSCI586/vendor/semsol/arc2/ARC2.php");

             $dbpconfig = array
             (
        // customize your endpoint address
             "remote_store_endpoint" => "http://localhost:3030/trumpeffect/sparql",
             );

             $store = ARC2::getRemoteStore($dbpconfig); 

             if ($errs = $store->getErrors()) 
             {
               echo "<h1>getRemoteSotre error<h1>" ;
             }

            if ($_POST['check']) {

                  // collect value of input field
              if($_POST['check'] == "totalvoters")
                {
                  $query = '
                        prefix xsd: <http://www.w3.org/2001/XMLSchema#>
                        prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                        prefix owl: <http://www.w3.org/2002/07/owl#>
                        prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                        SELECT ?VotedFor (COUNT(*) AS ?Count) 
                        WHERE {
                          ?recursiveuser rdfs:label ?User .
                          ?recursiveuser UserOnt:VotedFor ?VotedFor .
                        }
                        GROUP BY ?VotedFor
                         ';
                  $colOne = 'VotedFor';
                  $colTwo = 'Count';
                }
                else if($_POST['check'] == "ethnicity")
                {

                  $Ethnicity = array("White"=>"White", "Hispanic_or_Latin"=>"Hispanic or Latin", "Black_or_African_American"=>"Black or African American", "Middle_Eastern_or_North_African"=>"Middle Eastern or North African", "Native_American_or_American_Indian"=>"Native American or American Indian", "Asian_Pacific_Islander"=>"Asian Pacific Islander", "Other_Ethnicity"=>"Other Ethnicity");
                  
                  $result = array();
                  $allQueries = array();
                  foreach($Ethnicity as $x => $x_value)
                    {
                      $query = "prefix xsd: <http://www.w3.org/2001/XMLSchema#>
                                prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                                prefix owl: <http://www.w3.org/2002/07/owl#>
                                prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                                SELECT ?" . $x . " (COUNT(*) AS ?Count) 
                                WHERE {
                                  ?recursiveuser rdfs:label ?User .
                                  ?recursiveuser UserOnt:" . $x . " ?" . $x . "\r\n"
                                  . "FILTER (?" . $x . " = \"true\")
                                }
                                GROUP BY ?" . $x;
                      $colOne = $x;
                      $colTwo = 'Count';
                      $allQueries[] = $query;

                    $rows = $store->query($query, 'rows'); /* execute the query */

                        if ($errs = $store->getErrors()) 
                        {
                           echo "Query errors" ;
                           print_r($errs);
                        }
                        
                         foreach ($rows as $row) 
                        {   

                          if(!empty($row[$colOne]) || !empty($row[$colOne]))
                          {
                            $result[] = array($x_value, intval($row[$colTwo]));
                          }
                        }

                  }
                       echo json_encode(array($result, $allQueries));
                }
                else if($_POST['check'] == "origin")
                {

                  $Origin = array("Western_Southern_or_Northern_Europe"=>"Western Southern or Northern Europe", "Eastern_Europe"=>"Eastern Europe", "Middle_East_and_North_Africa"=>"Middle East and North Africa", "Sub_Saharan_Africa"=>"Sub Saharan Africa", "North_America"=>"North America", "Central_America"=>"Central America", "South_America"=>"South America", "Central_Asia"=>"Central Asia", "East_Asia"=>"East Asia", "South_Asia"=>"South Asia", "South_East_Asia"=>"South East Asia", "Oceania_Pacific_Islands"=>"Oceania Pacific Islands", "Other_Origin"=>"Other_Origin");
                  
                  $result = array();
                  $allQueries = array();
                  foreach($Origin as $x => $x_value)
                    {
                      $query = "prefix xsd: <http://www.w3.org/2001/XMLSchema#>
                                prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                                prefix owl: <http://www.w3.org/2002/07/owl#>
                                prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                                SELECT ?" . $x . " (COUNT(*) AS ?Count) 
                                WHERE {
                                  ?recursiveuser rdfs:label ?User .
                                  ?recursiveuser UserOnt:" . $x . " ?" . $x . "\r\n"
                                  . "FILTER (?" . $x . " = \"true\")
                                }
                                GROUP BY ?" . $x;
                      $colOne = $x;
                      $colTwo = 'Count';
                      $allQueries[] = $query;

                    $rows = $store->query($query, 'rows'); /* execute the query */

                        if ($errs = $store->getErrors()) 
                        {
                           echo "Query errors" ;
                           print_r($errs);
                        }
                        
                         foreach ($rows as $row) 
                        {   

                          if(!empty($row[$colOne]) || !empty($row[$colOne]))
                          {
                            $result[] = array($x_value, intval($row[$colTwo]));
                          }
                        }

                  }
                         echo json_encode(array($result, $allQueries));
                }
                else if($_POST['check'] == "leadertype")
                {

                  $Typeleader = array("Leader_who_speaks_his_mind"=>"Speaks His Mind", "Leader_with_Right_Experience"=>"Right Experience", "Leader_Who_can_bring_change"=>"Can Bring Change", "Leader_who_Cares_about_people"=>"Cares About People", "Leader_who_Focuses_on_Practical_Solution"=>"Focuses on Practical Solution", "Leader_who_is_Close_topeople"=>"Close to People");
                  
                  $result = array();
                  $allQueries = array();
                  foreach($Typeleader as $x => $x_value)
                    {
                      $query = "prefix xsd: <http://www.w3.org/2001/XMLSchema#>
                                prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                                prefix owl: <http://www.w3.org/2002/07/owl#>
                                prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                                SELECT ?" . $x . " (COUNT(*) AS ?Count) 
                                WHERE {
                                  ?recursiveuser rdfs:label ?User .
                                  ?recursiveuser UserOnt:" . $x . " ?" . $x . "\r\n"
                                  . "FILTER (?" . $x . " = \"6.0\")
                                }
                                GROUP BY ?" . $x;
                      $colOne = $x;
                      $colTwo = 'Count';
                      $allQueries[] = $query;

                    $rows = $store->query($query, 'rows'); /* execute the query */

                        if ($errs = $store->getErrors()) 
                        {
                           echo "Query errors" ;
                           print_r($errs);
                        }
                        
                         foreach ($rows as $row) 
                        {   

                          if(!empty($row[$colOne]) || !empty($row[$colOne]))
                          {
                            $result[] = array($x_value, intval($row[$colTwo]));
                          }
                        }

                  }
                         echo json_encode(array($result, $allQueries));
                }
                else if($_POST['check'] == "issues")
                {

                  $Issues = array("Environment_Protection"=>"Environment Protection", "Wealth_Redistribution"=>"Wealth Redistribution", "More_Jobs"=>"More Jobs", "Lower_Taxes"=>"Lower Taxes", "Better_schools"=>"Better Schools", "Better_Healthcare"=> "Better Healthcare", "Higher_Wages"=>"Higher Wages", "Higher_pensions"=>"Higher Pensions","Less_Immigration" => "Less Immigration", "Better_enforcement_of_law_and_order"=>"Better enforcement of law and order", "Equal_rights_for_minority_groups"=>"Equal rights for minority groups", "Lower_costs_of_living"=>"Lower costs of living", "Better_public_services"=>"Better public services", "Better_infrastructure"=>"Better Infrastructure", "Voting_Issues_None"=>"Voting Issues None");
                  
                  $result = array();
                  $allQueries = array();
                  foreach($Issues as $x => $x_value)
                    {
                      $query = "prefix xsd: <http://www.w3.org/2001/XMLSchema#>
                                prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                                prefix owl: <http://www.w3.org/2002/07/owl#>
                                prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                                SELECT ?" . $x . " (COUNT(*) AS ?Count) 
                                WHERE {
                                  ?recursiveuser rdfs:label ?User .
                                  ?recursiveuser UserOnt:" . $x . " ?" . $x . "\r\n"
                                  . "FILTER (?" . $x . " = \"true\")
                                }
                                GROUP BY ?" . $x;
                      $colOne = $x;
                      $colTwo = 'Count';  
                      $allQueries[] = $query;
                    $rows = $store->query($query, 'rows'); /* execute the query */

                        if ($errs = $store->getErrors()) 
                        {
                           echo "Query errors" ;
                           print_r($errs);
                        }
                        
                         foreach ($rows as $row) 
                        {   

                          if(!empty($row[$colOne]) || !empty($row[$colOne]))
                          {
                            $result[] = array($x_value, intval($row[$colTwo]));
                          }
                        }

                  }
                         echo json_encode(array($result, $allQueries));
                }
                else if($_POST['check'] == "socialmedia")
                {

                  $SocialMedia = array("Facebook"=>"Facebook", "Twitter"=>"Twitter", "Instagram"=>"Instagram", "Snapchat"=>"Snapchat", "Pinterest"=>"Pinterest", "LinkedIn"=>"LinkedIn", "GooglePlus"=>"GooglePlus", "Reddit"=>"Reddit", "WhatsApp"=>"WhatsApp", "WeChat"=>"WeChat", "Viber"=>"Viber", "Line"=>"Line", "YouTube"=>"YouTube", "My_own_blog"=>"My_own_blog", "Social_Media_None"=>"Social_Media_None");
                  
                  $result = array();
                  foreach($SocialMedia as $x => $x_value)
                    {
                      $query = "prefix xsd: <http://www.w3.org/2001/XMLSchema#>
                                prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                                prefix owl: <http://www.w3.org/2002/07/owl#>
                                prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                                SELECT ?" . $x . " (COUNT(*) AS ?Count) 
                                WHERE {
                                  ?recursiveuser rdfs:label ?User .
                                  ?recursiveuser UserOnt:" . $x . " ?" . $x . "\r\n"
                                  . "FILTER (?" . $x . " = \"true\")
                                }
                                GROUP BY ?" . $x;
                      $colOne = $x;
                      $colTwo = 'Count';  
                    $rows = $store->query($query, 'rows'); /* execute the query */

                        if ($errs = $store->getErrors()) 
                        {
                           echo "Query errors" ;
                           print_r($errs);
                        }
                        
                         foreach ($rows as $row) 
                        {   

                          if(!empty($row[$colOne]) || !empty($row[$colOne]))
                          {
                            $result[] = array($x_value, intval($row[$colTwo]));
                          }
                        }

                  }
                         echo json_encode(array($result, $query));
                }
                else if($_POST['check'] == "organization")
                {

                  $Organization = array("Sports_club"=>"Sports Club", "Political_party"=>"Political Party", "Religious_Institution"=>"Religious Institution", "Organization_None"=>"Organization None");
                  
                  $result = array();
                  $allQueries = array();
                  foreach($Organization as $x => $x_value)
                    {
                      $query = "prefix xsd: <http://www.w3.org/2001/XMLSchema#>
                                prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                                prefix owl: <http://www.w3.org/2002/07/owl#>
                                prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                                SELECT ?" . $x . " (COUNT(*) AS ?Count) 
                                WHERE {
                                  ?recursiveuser rdfs:label ?User .
                                  ?recursiveuser UserOnt:" . $x . " ?" . $x . "\r\n"
                                  . "FILTER (?" . $x . " = \"true\")
                                }
                                GROUP BY ?" . $x;
                      $colOne = $x;
                      $colTwo = 'Count'; 
                      $allQueries[] = $query; 
                    $rows = $store->query($query, 'rows'); /* execute the query */

                        if ($errs = $store->getErrors()) 
                        {
                           echo "Query errors" ;
                           print_r($errs);
                        }
                        
                         foreach ($rows as $row) 
                        {   

                          if(!empty($row[$colOne]) || !empty($row[$colOne]))
                          {
                            $result[] = array($x_value, intval($row[$colTwo]));
                          }
                        }

                  }
                         echo json_encode(array($result, $allQueries));
                }
                else if($_POST['check'] == "fbwt")
                {
                  $query = '
                        prefix xsd: <http://www.w3.org/2001/XMLSchema#>
                        prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                        prefix owl: <http://www.w3.org/2002/07/owl#>
                        prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                        SELECT ?VotedFor (COUNT(*) AS ?Count)
                        WHERE {
                          ?recursiveuser rdfs:label ?User .
                          ?recursiveuser UserOnt:VotedFor ?VotedFor .
                          ?recursiveuser UserOnt:Facebook ?Facebook .
                          ?recursiveuser UserOnt:WhatsApp ?WhatsApp .
                          FILTER (?Facebook = "true")
                          FILTER (?WhatsApp = "false")
                        }
                        GROUP BY ?VotedFor
                         ';
                  $colOne = 'VotedFor';
                  $colTwo = 'Count';
                }
                else if($_POST['check'] == "lowtax")
                {
                  $query = '
                        prefix xsd: <http://www.w3.org/2001/XMLSchema#>
                        prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                        prefix owl: <http://www.w3.org/2002/07/owl#>
                        prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                        SELECT ?VotedFor (COUNT(*) AS ?Count)
                        WHERE {
                          ?recursiveuser rdfs:label ?User .
                          ?recursiveuser UserOnt:VotedFor ?VotedFor .
                          ?recursiveuser UserOnt:Lower_Taxes ?Lower_Taxes .
                          ?recursiveuser UserOnt:age ?age .
                          FILTER (?Lower_Taxes = "true")
                          FILTER (?age >= "24" && ?age <= "36")
                        }
                        GROUP BY ?VotedFor
                         ';
                  $colOne = 'VotedFor';
                  $colTwo = 'Count';
                }
                else if($_POST['check'] == "lgbtq")
                {
                  $query = '
                        prefix xsd: <http://www.w3.org/2001/XMLSchema#>
                        prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                        prefix owl: <http://www.w3.org/2002/07/owl#>
                        prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                        SELECT ?VotedFor (COUNT(*) AS ?Count)
                        WHERE {
                          ?recursiveuser rdfs:label ?User .
                          ?recursiveuser UserOnt:VotedFor ?VotedFor .
                          ?recursiveuser UserOnt:LGBTQ ?LGBTQ .
                          ?recursiveuser UserOnt:Min_Income_Monthly ?Min_Income_Monthly .
                          ?recursiveuser UserOnt:Max_Income_Monthly ?Max_Income_Monthly .
                          FILTER (?LGBTQ = "Yes")
                          FILTER (?Min_Income_Monthly >= "2400" && ?Max_Income_Monthly <= "3200")
                        }
                        GROUP BY ?VotedFor
                         ';
                  $colOne = 'VotedFor';
                  $colTwo = 'Count';
                }
                else if ($_POST['check'] == 1 && $_POST['age'] && $_POST['media']) 
                {
                  $query = "prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                            prefix owl: <http://www.w3.org/2002/07/owl#>
                            prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                            SELECT ?VotedFor (COUNT(*) AS ?Count)
                            WHERE {
                              ?recursiveuser rdfs:label ?User .
                              ?recursiveuser UserOnt:VotedFor ?VotedFor .
                              ?recursiveuser UserOnt:age ?age .
                              ?recursiveuser UserOnt:Facebook ?Facebook .
                              ?recursiveuser UserOnt:Twitter ?Twitter .
                              ?recursiveuser UserOnt:Instagram ?Instagram .
                              ?recursiveuser UserOnt:Snapchat ?Snapchat .
                              ?recursiveuser UserOnt:Pinterest ?Pinterest .
                              ?recursiveuser UserOnt:LinkedIn ?LinkedIn .
                              ?recursiveuser UserOnt:Reddit ?Reddit .
                              ?recursiveuser UserOnt:WhatsApp ?WhatsApp .
                              ?recursiveuser UserOnt:WeChat ?WeChat .
                              ?recursiveuser UserOnt:Viber ?Viber .
                              ?recursiveuser UserOnt:Line ?Line .
                              ?recursiveuser UserOnt:YouTube ?YouTube .
                              ?recursiveuser UserOnt:My_own_blog ?My_own_blog .
                              ?recursiveuser UserOnt:Social_Media_None ?Social_Media_None .";
                  $query .= "\r\n";

                  if ($_POST['age'] == "18-20") 
                  {
                    $query .= "FILTER (?age > \"18\" && ?age < \"20\")";
                  }
                  else if ($_POST['age'] == "20-30") 
                  {
                    $query .= "FILTER (?age > \"20\" && ?age < \"30\")";
                  }
                  else if ($_POST['age'] == '30-40') 
                  {
                    $query .= "FILTER (?age > \"30\" && ?age < \"40\")";
                  }
                  else if ($_POST['age'] == '40-50') 
                  {
                    $query .= "FILTER (?age > \"40\" && ?age < \"50\")";
                  }
                  else if ($_POST['age'] == '50-60') 
                  {
                    $query .= "FILTER (?age > \"50\" && ?age < \"60\")";
                  }
                  else if ($_POST['age'] == '60-70') 
                  {
                    $query .= "FILTER (?age > \"60\" && ?age < \"70\")";
                  }
                  else if ($_POST['age'] == '70-80') 
                  {
                    $query .= "FILTER (?age > \"70\" && ?age < \"80\")";
                  }
                  else if ($_POST['age'] == '80-90') 
                  {
                    $query .= "FILTER (?age > \"80\" && ?age < \"90\")";
                  }else if ($_POST['age'] == '90-100') 
                  {
                    $query .= "FILTER (?age > \"90\" && ?age < \"100\")";
                  }
                  $query .= "\r\n";
                  foreach ($_POST['media'] as $mediaVal) {
                    $query .= "FILTER (?" . $mediaVal . "= \"true\")";
                  }
                  $query .= "\r\n";
                  $query .= "} GROUP BY ?VotedFor";

                  $colOne = 'VotedFor';
                  $colTwo = 'Count';

                }
                else if ($_POST['check'] == 2 && $_POST['popln'] && $_POST['issues']) 
                {
                  $query = "prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                            prefix owl: <http://www.w3.org/2002/07/owl#>
                            prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                            SELECT ?VotedFor (COUNT(*) AS ?Count)
                            WHERE {
                              ?recursiveuser rdfs:label ?User .
                              ?recursiveuser UserOnt:VotedFor ?VotedFor .
                              ?recursiveuser UserOnt:Urbanisation ?Urbanisation .
                              ?recursiveuser UserOnt:Environment_Protection ?Environment_Protection .
                              ?recursiveuser UserOnt:Wealth_Redistribution ?Wealth_Redistribution .
                              ?recursiveuser UserOnt:Lower_Taxes ?Lower_Taxes .
                              ?recursiveuser UserOnt:More_Jobs ?More_Jobs .
                              ?recursiveuser UserOnt:Less_Immigration ?Less_Immigration .
                              ?recursiveuser UserOnt:Better_schools ?Better_schools .
                              ?recursiveuser UserOnt:Better_Healthcare ?Better_Healthcare .
                              ?recursiveuser UserOnt:Higher_Wages ?Higher_Wages .
                              ?recursiveuser UserOnt:Higher_pensions ?Higher_pensions .
                              ?recursiveuser UserOnt:Equal_rights_for_minority_groups ?Equal_rights_for_minority_groups .
                              ?recursiveuser UserOnt:Better_enforcement_of_law_and_order ?Better_enforcement_of_law_and_orders .
                              ?recursiveuser UserOnt:Lower_costs_of_living ?Lower_costs_of_living .
                              ?recursiveuser UserOnt:Better_public_services ?Better_public_services .
                              ?recursiveuser UserOnt:Better_infrastructure ?Better_infrastructure .
                              ?recursiveuser UserOnt:Voting_Issues_None ?Voting_Issues_None .
                            ";

                  $query .= "\r\n";

                  if($_POST['popln'] == "rural")
                  {
                    $query .= "FILTER (?Urbanisation = \"rural\")";
                  }
                  else if ($_POST['popln'] == "city") 
                  {
                    $query .= "FILTER (?Urbanisation = \"city\")";
                  }

                  $query .= "\r\n";

                  foreach ($_POST['issues'] as $issuesVal) {
                    $query .= "FILTER (?" . $issuesVal . "= \"true\")";
                  }
                  $query .= "\r\n";
                  $query .= "} GROUP BY ?VotedFor";

                  $colOne = 'VotedFor';
                  $colTwo = 'Count';
                }
                else if ($_POST['check'] == 3 && $_POST['employment'] && $_POST['salary'] && $_POST['gender']&& $_POST['votedFor']) 
                {

                  $typeOfLeader = array();
                  $typeOfLeader = array("Leader_who_speaks_his_mind"=>"Speaks His Mind", "Leader_with_Right_Experience"=>"Right Experience", "Leader_Who_can_bring_change"=>"Can Bring Change", "Leader_who_Cares_about_people"=>"Cares About People", "Leader_who_Focuses_on_Practical_Solution"=>"Focuses on Practical Solution", "Leader_who_is_Close_topeople"=>"Close to People");
                  
                  $result = array();
                  $allQueries = array();
                  foreach($typeOfLeader as $x => $x_value)
                  {
                    $query = "prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                                  prefix owl: <http://www.w3.org/2002/07/owl#>
                                  prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                                  SELECT ?" . $x . " (COUNT(*) AS ?Count)" . "\r\n";
                    $query .= "WHERE {
                                    ?recursiveuser rdfs:label ?User .
                                    ?recursiveuser UserOnt:VotedFor ?VotedFor .
                                    ?recursiveuser UserOnt:gender ?gender .
                                    ?recursiveuser UserOnt:Employment_Status ?Employment_Status .
                                    ?recursiveuser UserOnt:Min_Income_Monthly ?Min_Income_Monthly .
                                    ?recursiveuser UserOnt:Max_Income_Monthly ?Max_Income_Monthly .
                                    ?recursiveuser UserOnt:";
                    $query .= $x . " ?" . $x . " ." . "\r\n"; 

                      if($_POST['employment'] == "employed")
                      {
                        $query .= "FILTER (?Employment_Status = \"Employed\")" . "\r\n";
                      }
                      else if($_POST['employment'] == "unemployed")
                      {
                        $query .= "FILTER (?Employment_Status = \"Unemployed\")" . "\r\n";
                      }

                      if($_POST['gender'] == "male")
                      {
                        $query .= "FILTER (?gender  = \"male\")" . "\r\n";
                      }
                      else if($_POST['gender'] == "female")
                      {
                        $query .= "FILTER (?gender  = \"female\")" . "\r\n";
                      }

                      if($_POST['votedFor'] == "Donald Trump")
                      {
                        $query .= "FILTER (?VotedFor  = \"Donald Trump\")" . "\r\n";
                      }
                      else if($_POST['votedFor'] == "Hillary Clinton")
                      {
                        $query .= "FILTER (?VotedFor  = \"Hillary Clinton\")" . "\r\n";
                      }

                      if($_POST['salary'] == "0-3000")
                      {
                        $query .= "FILTER (?Min_Income_Monthly  >= \"0.0\")" . "\r\n";
                        $query .= "FILTER (?Max_Income_Monthly  <= \"3001.0\")" . "\r\n";
                      }
                      else if($_POST['salary'] == "3000-6000")
                      {
                        $query .= "FILTER (?Min_Income_Monthly  >= \"3000.0\")" . "\r\n";
                        $query .= "FILTER (?Max_Income_Monthly  <= \"6001.0\")" . "\r\n";
                      }
                      else if($_POST['salary'] == "6000-9000")
                      {
                        $query .= "FILTER (?Min_Income_Monthly  >= \"6000.0\")" . "\r\n";
                        $query .= "FILTER (?Max_Income_Monthly  <= \"9001.0\")" . "\r\n";
                      }
                      else if($_POST['salary'] == "9000-12000")
                      {
                        $query .= "FILTER (?Min_Income_Monthly  >= \"9000.0\")" . "\r\n";
                        $query .= "FILTER (?Max_Income_Monthly  <= \"12000.0\")" . "\r\n";
                      }
                      else if($_POST['salary'] == "12000+")
                      {
                        $query .= "FILTER (?Min_Income_Monthly  >= \"12000.0\")" . "\r\n";
                        $query .= "FILTER (?Max_Income_Monthly  <= \"12001.0\")" . "\r\n";
                      }

                      $query .= "FILTER (?" . $x . " = \"6.0\")" . "\r\n";
                      $query .= "}
                                      GROUP BY ?" . $x;

                      $colOne = $x;
                      $colTwo = 'Count';
                      $allQueries[] = $query;
                      // execute for each query

                      $rows = $store->query($query, 'rows'); /* execute the query */

                        if ($errs = $store->getErrors()) 
                        {
                           echo "Query errors" ;
                           print_r($errs);
                        }
                        
                         foreach ($rows as $row) 
                        {   

                          if(!empty($row[$colOne]) || !empty($row[$colOne]))
                          {
                            $result[] = array($x_value, intval($row[$colTwo]));
                          }
                        }

                  }
                        echo json_encode(array($result, $allQueries));
                }

                else if ($_POST['check'] == 4 && $_POST['education'] && $_POST['votedForIssues'] && $_POST['opinion']&& $_POST['ethnicity']) 
                {

                  $Issues = array();
                  $allQueries = array();
                  $Issues = array("Environment_Protection"=>"Environment Protection", "Wealth_Redistribution"=>"Wealth Redistribution", "More_Jobs"=>"More Jobs", "Lower_Taxes"=>"Lower Taxes", "Better_schools"=>"Better Schools", "Better_Healthcare"=> "Better Healthcare", "Higher_Wages"=>"Higher Wages", "Higher_pensions"=>"Higher Pensions", "Better_enforcement_of_law_and_order"=>"Better enforcement of law and order", "Equal_rights_for_minority_groups"=>"Equal rights for minority groups", "Lower_costs_of_living"=>"Lower costs of living", "Better_public_services"=>"Better public services", "Better_infrastructure"=>"Better Infrastructure", "Voting_Issues_None"=>"Voting Issues None");
                  
                  $result = array();
                  foreach($Issues as $x => $x_value)
                  {
                    $query = "prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                                  prefix owl: <http://www.w3.org/2002/07/owl#>
                                  prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                                  SELECT ?" . $x . " (COUNT(*) AS ?Count)" . "\r\n";
                    $query .= "WHERE {
                                        ?recursiveuser rdfs:label ?User .
                                        ?recursiveuser UserOnt:VotedFor ?VotedFor .
                                        ?recursiveuser UserOnt:Education_Level ?Education_Level .
                                        ?recursiveuser UserOnt:Opinion_Govt ?Opinion_Govt ." . "\r\n";
                                        foreach ($_POST['ethnicity'] as $eVal) {
                                              $query .= "?recursiveuser UserOnt:" . $eVal . " ?" . $eVal . " ." ."\r\n";
                                            }
                      $query .= "?recursiveuser UserOnt:" . $x . " ?" . $x . "\r\n";

                      // Education

                      if($_POST['education'] == "University")
                      {
                        $query .= "FILTER (?Education_Level = \"University\")" . "\r\n";
                      }
                      else if($_POST['education'] == "High School Education")
                      {
                        $query .= "FILTER (?Education_Level = \"High School Education\")" . "\r\n";
                      }
                      else if($_POST['education'] == "Secondary School")
                      {
                        $query .= "FILTER (?Education_Level = \"Secondary School\")" . "\r\n";
                      }
                      else if($_POST['education'] == "None")
                      {
                        $query .= "FILTER (?Education_Level = \"None\")" . "\r\n";
                      }
                      else if($_POST['education'] == "Prefer not to answer")
                      {
                        $query .= "FILTER (?Education_Level = \"Prefer not to answer\")" . "\r\n";
                      }

                      //Opinion

                      if($_POST['opinion'] == "Very positive")
                      {
                        $query .= "FILTER (?Opinion_Govt  = \"Very positive\")" . "\r\n";
                      }
                      else if($_POST['opinion'] == "Somewhat positive")
                      {
                        $query .= "FILTER (?Opinion_Govt  = \"Somewhat positive\")" . "\r\n";
                      }
                      else if($_POST['opinion'] == "Neither positive nor negative")
                      {
                        $query .= "FILTER (?Opinion_Govt  = \"Neither positive nor negative\")" . "\r\n";
                      }
                      else if($_POST['opinion'] == "Somewhat negative")
                      {
                        $query .= "FILTER (?Opinion_Govt  = \"Somewhat negative\")" . "\r\n";
                      }
                      else if($_POST['opinion'] == "Very negative")
                      {
                        $query .= "FILTER (?Opinion_Govt  = \"Very negative\")" . "\r\n";
                      }

                      // VotedFor

                      if($_POST['votedForIssues'] == "Donald Trump")
                      {
                        $query .= "FILTER (?VotedFor  = \"Donald Trump\")" . "\r\n";
                      }
                      else if($_POST['votedForIssues'] == "Hillary Clinton")
                      {
                        $query .= "FILTER (?VotedFor  = \"Hillary Clinton\")" . "\r\n";
                      }

                      foreach ($_POST['ethnicity'] as $ethnicityVal) 
                      {
                        $query .= "FILTER (?" . $ethnicityVal . "= \"true\")";
                      }

                      $query .= "FILTER (?" . $x . " = \"true\")" . "\r\n";
                      $query .= "}
                                      GROUP BY ?" . $x;

                      $colOne = $x;
                      $colTwo = 'Count';

                      $allQueries[] = $query;

                      $rows = $store->query($query, 'rows'); /* execute the query */

                        if ($errs = $store->getErrors()) 
                        {
                           echo "Query errors" ;
                           print_r($errs);
                        }
                      
                         foreach ($rows as $row) 
                        {   

                          if(!empty($row[$colOne]) || !empty($row[$colOne]))
                          {
                            $result[] = array($x_value, intval($row[$colTwo]));
                          }
                        }
                  }
                        echo json_encode(array($result, $allQueries));
                }
                
                else if ($_POST['check'] == 5 && $_POST['frequency'] && $_POST['votedForAnalysisOne'] && $_POST['organization']) 
                {
                  $Origin = array("Western_Southern_or_Northern_Europe"=>"Western Southern or Northern Europe", "Eastern_Europe"=>"Eastern Europe", "Middle_East_and_North_Africa"=>"Middle East and North Africa", "Sub_Saharan_Africa"=>"Sub Saharan Africa", "North_America"=>"North America", "Central_America"=>"Central America", "South_America"=>"South America", "Central_Asia"=>"Central Asia", "East_Asia"=>"East Asia", "South_Asia"=>"South Asia", "South_East_Asia"=>"South East Asia", "Oceania_Pacific_Islands"=>"Oceania Pacific Islands", "Other_Origin"=>"Other_Origin");
                  
                  $result = array();
                  $allQueries = array();
                  foreach($Origin as $x => $x_value)
                  {

                    $query = "prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                                  prefix owl: <http://www.w3.org/2002/07/owl#>
                                  prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                                  SELECT ?" . $x . " (COUNT(*) AS ?Count)" . "\r\n";
                    $query .= "WHERE {
                                        ?recursiveuser rdfs:label ?User .
                                        ?recursiveuser UserOnt:VotedFor ?VotedFor .                                        
                                        ?recursiveuser UserOnt:frequency_of_voting ?frequency_of_voting .
                                        ?recursiveuser UserOnt:Political_party ?Political_party ." . "\r\n";
                                        foreach ($_POST['organization'] as $eVal) {
                                              $query .= "?recursiveuser UserOnt:" . $eVal . " ?" . $eVal . " ." ."\r\n";
                                            }
                      $query .= "?recursiveuser UserOnt:" . $x . " ?" . $x . "\r\n";

                      // Frequency

                      if($_POST['frequency'] == "Always")
                      {
                        $query .= "FILTER (?frequency_of_voting = \"Always\")" . "\r\n";
                      }
                      else if($_POST['frequency'] == "Most of the time")
                      {
                        $query .= "FILTER (?frequency_of_voting = \"Most of the time\")" . "\r\n";
                      }
                      else if($_POST['frequency'] == "Sometimes")
                      {
                        $query .= "FILTER (?frequency_of_voting = \"Sometimes\")" . "\r\n";
                      }
                      else if($_POST['frequency'] == "Rarely")
                      {
                        $query .= "FILTER (?frequency_of_voting = \"Rarely\")" . "\r\n";
                      }
                      else if($_POST['frequency'] == "I have never been eligible to vote")
                      {
                        $query .= "FILTER (?frequency_of_voting = \"I have never been eligible to vote\")" . "\r\n";
                      }

                      // VotedFor

                      if($_POST['votedForAnalysisOne'] == "Donald Trump")
                      {
                        $query .= "FILTER (?VotedFor  = \"Donald Trump\")" . "\r\n";
                      }
                      else if($_POST['votedForAnalysisOne'] == "Hillary Clinton")
                      {
                        $query .= "FILTER (?VotedFor  = \"Hillary Clinton\")" . "\r\n";
                      }

                      foreach ($_POST['organization'] as $orgVal) 
                      {
                        $query .= "FILTER (?" . $orgVal . "= \"true\")";
                      }

                      $query .= "FILTER (?" . $x . " = \"true\")" . "\r\n";
                      $query .= "}
                                      GROUP BY ?" . $x;

                      $colOne = $x;
                      $colTwo = 'Count';

                      $allQueries[] = $query;
                      $rows = $store->query($query, 'rows'); /* execute the query */

                        if ($errs = $store->getErrors()) 
                        {
                           echo "Query errors" ;
                           print_r($errs);
                        }
                        
                         foreach ($rows as $row) 
                        {   

                          if(!empty($row[$colOne]) || !empty($row[$colOne]))
                          {
                            $result[] = array($x_value, intval($row[$colTwo]));
                          }
                        }

                  }
                        echo json_encode(array($result, $allQueries));
                }
                else if ($_POST['check'] == 6 && $_POST['diversity'] && $_POST['issuesAnalysisTwo'] && $_POST['originAnalysisTwo']) 
                {
                  $query = "prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                            prefix owl: <http://www.w3.org/2002/07/owl#>
                            prefix UserOnt: <https://github.com/deepika087/CSCI-586-Group-2/blob/master/TrumpOntology.owl>
                            SELECT ?VotedFor (COUNT(*) AS ?Count)
                            WHERE {
                            ?recursiveuser rdfs:label ?User .
                            ?recursiveuser UserOnt:VotedFor ?VotedFor .
                            ?recursiveuser UserOnt:Perceived_Effect_of_diversity ?Perceived_Effect_of_diversity ."
                            . "\r\n";

                  foreach ($_POST['originAnalysisTwo'] as $x) {
                    $query .= "?recursiveuser UserOnt:" . $x . " ?" . $x . " ." . "\r\n";
                  }
                  foreach ($_POST['issuesAnalysisTwo'] as $x) {
                    $query .= "?recursiveuser UserOnt:" . $x . " ?" . $x . " ." . "\r\n";
                  }

                  foreach ($_POST['originAnalysisTwo'] as $orgVal) 
                  {
                    $query .= "FILTER (?" . $orgVal . "= \"true\")" . "\r\n";
                  }

                  foreach ($_POST['issuesAnalysisTwo'] as $issVal) 
                  {
                    $query .= "FILTER (?" . $issVal . "= \"true\")" . "\r\n";
                  }

                  if($_POST['diversity'] == "Very positively")
                  {
                      $query .= "FILTER (?Perceived_Effect_of_diversity = \"Very positively\")";
                  }
                  else if ($_POST['diversity'] == "Somewhat positively") 
                  {
                    $query .= "FILTER (?Perceived_Effect_of_diversity = \"Somewhat positively\")";
                  }
                  else if ($_POST['diversity'] == "Neither positively nor negatively") 
                  {
                    $query .= "FILTER (?Perceived_Effect_of_diversity = \"Neither positively nor negatively\")";
                  }
                  else if ($_POST['diversity'] == 'Somewhat negatively') 
                  {
                    $query .= "FILTER (?Perceived_Effect_of_diversity = \"Somewhat negatively\")";
                  }
                  else if ($_POST['diversity'] == 'Very negatively') 
                  {
                    $query .= "FILTER (?Perceived_Effect_of_diversity = \"Very negatively\")";
                  }

                  $query .= "\r\n";
                  $query .= "} GROUP BY ?VotedFor";

                  $colOne = 'VotedFor';
                  $colTwo = 'Count';
                }   

                   if($_POST['check'] == 1 || $_POST['check'] == 2 || $_POST['check'] == 6 || $_POST['check'] == "totalvoters" || $_POST['check'] == "lgbtq" || $_POST['check'] == "lowtax" || $_POST['check'] == "fbwt")
                   {
                   $rows = $store->query($query, 'rows'); /* execute the query */

                    if ($errs = $store->getErrors()) 
                    {
                       echo "Query errors" ;
                       print_r($errs);
                    }
                    $result = array();

                   foreach ($rows as $row) 
                  {   

                    if(!empty($row[$colOne]) || !empty($row[$colOne]))
                    {
                      $result[] = array($row[$colOne], intval($row[$colTwo]));
                    }
                  }

                  echo json_encode(array($result, $query));
                  }
              }

             
          ?>

