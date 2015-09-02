
<div class="panel callout">
	<h4 style="display:inline">Maintain Employee Record</h4>
    <a href="<?php echo $uri->link("employees/index") ?>"><span class="button secondary right" style="display:inline"> &laquo;Back To Listing</span></a>
    <a href="<?php 
    global $session; 
    //echo $session->department;
    //print_r($session->privil);
    
    if($session->department=="Technical Department" && in_array("itdepartment", $session->privil) && $session->rolename=="Customer Support Engineer"){
        echo $uri->link("dashboard/index");
    }elseif($session->rolename=="Customer Support Service" && in_array("support", $session->privil)){
        echo $uri->link("dashboard/index");
    }elseif(($session->department=="Humman Resource" || $session=="Human Resource Deparment")){
        
    }elseif((($session->rolename=="Super Admin") || $session->rolename=="General Manager") && $session->department=="Technical Department"){
        echo $uri->link("dashboard/index");       
    }
     
    ?>"><span class="btn btn-primary button right" style="display:inline"> &laquo;Back To Dashboard</span></a>
</div>

<div id="myModal" class="reveal-modal medium" data-animation="fade" style="background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px">
  <h2>Maintain Instituttion Window</h2>
  <hr />
  <div id="alertme"></div>
  <div id="instdataModal"></div>
	 <a class="close-reveal-modal"><strong><img src="public/icons/Close16.png" width="16" height="16" /></strong></a>
</div>


<div id="myModal2" class="reveal-modal medium" data-animation="fade" style="background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px">
  <h2>Maintain Works Experience Window</h2>
  <hr />
  <div id="alertme2"></div>
  <div id="workdataModal"></div>
	 <a class="close-reveal-modal"><img src="public/icons/Close16.png" width="16" height="16" /></a>
</div>


<div id="myModal3" class="reveal-modal medium" data-animation="fade" style="background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px">
  <h2>Maintain Employee Next of Kin info</h2>
  <hr />
  <div id="alertme3"></div>
  <div id="nokdataModal"></div>
	 <a class="close-reveal-modal"><strong><img src="public/icons/Close16.png" width="16" height="16" /></strong></a>
</div>

<div id="myModal4" class="reveal-modal medium" data-animation="fade" style="background-image: linear-gradient(0deg, #f2f9fc, #addcf0 20.0em); border-radius:5px">
  <h2>Maintain Employee Referees</h2>
  <hr />
  <div id="alertme4"></div>
  <div id="refdataModal"></div>
	 <a class="close-reveal-modal"><strong><img src="public/icons/Close16.png" width="16" height="16" /></strong></a>
</div>






<form action="<?php echo $uri->link("employees/doUpdate/") ?>" method="post"  name="frmEmp"  id="frmEmp" >
<input type="hidden" id="empid" name="empid" value="<?php echo $this->employee->id ?>"/>
<input type="hidden" id="staffid" name="staffid" value="<?php echo $this->employee->emp_id ?>"/>
<div id="transalert"></div>
    <fieldset>
      <legend>Modify and Maintain Employee Record</legend>
      <!--
<div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Title</label>
        </div>
        <div class="small-10 columns">
        <input type="text" placeholder="Title" class="six"   name="title" id="title" />
        </div>
      </div>
-->
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Firstname <span class="red">*</span></label>
        </div>
        <div class="small-10 columns">
        <input type="text" placeholder="firstname" value="<?php echo $this->employee->emp_fname ?>" class="six" required='required'  name="fname" id="fname" />
        <div id="fnm"></div>
        </div>
      </div>
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Lastname<span class="red">*</span></label>
        </div>
        <div class="small-10 columns">
        <input type="text" placeholder="lastname" value="<?php echo $this->employee->emp_lname ?>" class="six" required='required'  name="lname" id="lname" />
        <div id="lnm"></div>
        </div>
      </div>
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Date of Birth<span class="red">*</span></label>
        </div>
        <div class="small-10 columns">
        <input type="text" placeholder="Date of Birth" class="six" required='required'  name="dob1" id="dob1" value="<?php echo $this->employee->emp_dob ?>" />
        </div>
      </div>
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Gender</label>
        </div>
        <div class="small-10 columns">
        <select id="gender"  name="gender">
            <option >--SELECT GENDER--</option>
            <option value="<?php echo !empty($this->employee->gender) ? $this->employee->gender :""  ?>"><?php echo !empty($this->employee->gender) ? $this->employee->gender :"--SELECT GENDER--"  ?></option>
            <option value="Female">Female</option>
            <option value="Male">Male</option>
            
          </select>
        </div>
      </div>
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Marital Status<span class="red">*</span></label>
        </div>
        <div class="small-10 columns">
        <select id="mstatus" name="mstatus">
            <option value="<?php echo !empty($this->employee->emp_mstatus) ? $this->employee->emp_mstatus :""  ?>"><?php echo !empty($this->employee->emp_mstatus) ? $this->employee->emp_mstatus :"--SELECT MARITAL STATUS--"  ?></option>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Divorced">Divorced</option>
            <option value="Widow">Widow</option>
            <option value="Widower">Widower</option>
            
          </select>
        </div>
      </div>
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Religion</label>
        </div>
        <div class="small-10 columns">
        <select id="religion" name="religion">
            <option value="<?php echo !empty($this->employee->emp_religion) ? $this->employee->emp_religion :""  ?>"><?php echo !empty($this->employee->emp_religion) ? $this->employee->emp_religion :"--SELECT RELIGION--"  ?></option>
            <option value="Christianity">Christianity</option>
            <option value="Islam">Islam</option>
            <option value="Othres">Others</option>      
          </select>
        </div>
      </div>
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Address<span class="red">*</span></label>
        </div>
        <div class="small-10 columns">
        <textarea id="address" name="address" rows="10" cols="10"><?php echo $this->employee->emp_address ?></textarea>
        <div id="add"></div>
        </div>
      </div>
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Nationality<span class="red">*</span></label>
        </div>
        <div class="small-10 columns">
        <select id="nationality" name="nationality">
            <option value="<?php echo !empty($this->employee->emp_nationality) ? $this->employee->emp_nationality :""  ?>"><?php echo !empty($this->employee->emp_nationality) ? $this->employee->emp_nationality :"--SELECT NATIONALITY--"  ?></option>
            <option value="Nigerian">Nigerian</option>
            <option value="Othres">Others</option>      
          </select>
        </div>
      </div>
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">State of Origin<span class="red">*</span></label>
        </div>
        <div class="small-10 columns">
        <select id="soo" name="soo">
            <option selected="selected" value="<?php echo !empty($this->employee->emp_soo) ? $this->employee->emp_soo :""  ?>"><?php echo !empty($this->employee->emp_soo) ? $this->employee->emp_soo :""  ?></option>
            <?php
                if($this->state){
                    foreach($this->state as $state){
                        echo "<option value='{$state->zone_id},{$state->name}'>$state->name</option>";
                    }
               }
           ?>    
          </select>
          <div id="fsoo"></div>
        </div>
      </div>
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Local Government Area<span class="red">*</span></label>
        </div>
        <div class="small-10 columns">
        <select id="lga" name="lga">
            <option value="<?php echo !empty($this->employee->emp_lga) ? $this->employee->emp_lga :""  ?>" ><?php echo !empty($this->employee->emp_lga) ? $this->employee->emp_lga :"--SELECT LGA--"  ?></option>
                
            <option value="Othres">Others</option>      
          </select>
        </div>
      </div>
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Telephone(s)<small>seperate telephone numbers with comma(,)</small><span class="red">*</span></label>
        </div>
        <div class="small-10 columns">
        <input type="text" placeholder="Telephone" class="six" required='required' value="<?php echo $this->employee->emp_phone ?>"  name="phone" id="phone" />
        <div id="tph"></div>
        </div>
      </div>
      <div class="row">
        <div class="small-2 columns">
        <label for="right-label" class="left inline">Email<span class="red">*</span></label>
        </div>
        <div class="small-10 columns">
        <input type="email" placeholder="Email" class="six" required='required'  name="email" id="email" value="<?php echo $this->employee->emp_email ?>" />
        <div id="femail"></div>
        </div>
      </div>
      <input type="submit" class="button offset-by-five" name="submit" id="submit" value="save" />
      <hr />
      <div class="row">
        <div class="section-container auto" data-section >
          <section class="active">
            <p class="title" data-section-title ><a href="#panel1">Institution</a></p>
            <div class="content" data-section-content >
            <p><h4>Institutions </h4><i>Attended with date</i></p>
            <div id="tblins"><?php echo $this->empinst ?></div>
            <a href="#" id="triglink1"><img id="" src="public/icons/Add16.png" /> Add New</a>
            <hr />
            <div id="divins" style="display: none; background-color:#768b96; padding: 10px; color: #fff;">
              <div class="row">
                <div class="small-2 columns">
                <label for="right-label" class="left inline">Institution</label>
                </div>
                <div class="small-10 columns">
                    <input type="text" name="institution" id="institution" />
                </div>
              </div>
              <div class="row">
                <div class="small-2 columns">
                <label for="right-label" class="left inline">Year</label>
                </div>
                <div class="small-10 columns">
                    <div class="small-1 columns"><label>From</label></div>
                    <div class="small-5 columns">
                        <select id="insdatefro" name="insdatefro">
                            <option label="Year" value="">Year</option>
                            <option label="1970" value="1970">1970</option>
                            <option label="1971" value="1971">1971</option>
                            <option label="1972" value="1972">1972</option>
                            <option label="1973" value="1973">1973</option>
                            <option label="1974" value="1974">1974</option>
                            <option label="1975" value="1975">1975</option>
                            <option label="1976" value="1976">1976</option>
                            <option label="1977" value="1977">1977</option>
                            <option label="1978" value="1978">1978</option>
                            <option label="1979" value="1979">1979</option>
                            <option label="1980" value="1980">1980</option>
                            <option label="1981" value="1981">1981</option>
                            <option label="1982" value="1982">1982</option>
                            <option label="1983" value="1983">1983</option>
                            <option label="1984" value="1984">1984</option>
                            <option label="1985" value="1985">1985</option>
                            <option label="1986" value="1986">1986</option>
                            <option label="1987" value="1987">1987</option>
                            <option label="1988" value="1988">1988</option>
                            <option label="1989" value="1989">1989</option>
                            <option label="1990" value="1990">1990</option>
                            <option label="1991" value="1991">1991</option>
                            <option label="1992" value="1992">1992</option>
                            <option label="1993" value="1993">1993</option>
                            <option label="1994" value="1994">1994</option>
                            <option label="1995" value="1995">1995</option>
                            <option label="1996" value="1996">1996</option>
                            <option label="1997" value="1997">1997</option>
                            <option label="1998" value="1998">1998</option>
                            <option label="1999" value="1999">1999</option>
                            <option label="2000" value="2000">2000</option>
                            <option label="2001" value="2001">2001</option>
                            <option label="2002" value="2002">2002</option>
                            <option label="2003" value="2003">2003</option>
                            <option label="2004" value="2004">2004</option>
                            <option label="2005" value="2005">2005</option>
                            <option label="2006" value="2006">2006</option>
                            <option label="2007" value="2007">2007</option>
                            <option label="2008" value="2008">2008</option>
                            <option label="2009" value="2009">2009</option>
                            <option label="2010" value="2010">2010</option>
                            <option label="2011" value="2011">2011</option>
                            <option label="2012" value="2012">2012</option>
                            <option label="2013" value="2013" selected="selected">2013</option>
                            <option label="2014" value="2014">2014</option>
                        </select>
                        
                    </div>
                    <div class="small-1 columns"><label>To</label></div>
                    <div class="small-5 columns">
                        <select id="insdateto" name="insdateto">
                            <option label="Year" value="">Year</option>
                            <option label="1970" value="1970">1970</option>
                            <option label="1971" value="1971">1971</option>
                            <option label="1972" value="1972">1972</option>
                            <option label="1973" value="1973">1973</option>
                            <option label="1974" value="1974">1974</option>
                            <option label="1975" value="1975">1975</option>
                            <option label="1976" value="1976">1976</option>
                            <option label="1977" value="1977">1977</option>
                            <option label="1978" value="1978">1978</option>
                            <option label="1979" value="1979">1979</option>
                            <option label="1980" value="1980">1980</option>
                            <option label="1981" value="1981">1981</option>
                            <option label="1982" value="1982">1982</option>
                            <option label="1983" value="1983">1983</option>
                            <option label="1984" value="1984">1984</option>
                            <option label="1985" value="1985">1985</option>
                            <option label="1986" value="1986">1986</option>
                            <option label="1987" value="1987">1987</option>
                            <option label="1988" value="1988">1988</option>
                            <option label="1989" value="1989">1989</option>
                            <option label="1990" value="1990">1990</option>
                            <option label="1991" value="1991">1991</option>
                            <option label="1992" value="1992">1992</option>
                            <option label="1993" value="1993">1993</option>
                            <option label="1994" value="1994">1994</option>
                            <option label="1995" value="1995">1995</option>
                            <option label="1996" value="1996">1996</option>
                            <option label="1997" value="1997">1997</option>
                            <option label="1998" value="1998">1998</option>
                            <option label="1999" value="1999">1999</option>
                            <option label="2000" value="2000">2000</option>
                            <option label="2001" value="2001">2001</option>
                            <option label="2002" value="2002">2002</option>
                            <option label="2003" value="2003">2003</option>
                            <option label="2004" value="2004">2004</option>
                            <option label="2005" value="2005">2005</option>
                            <option label="2006" value="2006">2006</option>
                            <option label="2007" value="2007">2007</option>
                            <option label="2008" value="2008">2008</option>
                            <option label="2009" value="2009">2009</option>
                            <option label="2010" value="2010">2010</option>
                            <option label="2011" value="2011">2011</option>
                            <option label="2012" value="2012">2012</option>
                            <option label="2013" value="2013" selected="selected">2013</option>
                            <option label="2014" value="2014">2014</option>
                            </select>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="small-2 columns">
                <label for="right-label" class="left inline">Qualification</label>
                </div>
                <div class="small-10 columns">
                    <select name="qualification" id="qualification" >
                        <option value="">--SELECT QUALIFICATION--</option>
                        <option label="MPhil / PhD" value="MPhil / PhD">MPhil / PhD</option>
                        <option label="MBA / MSc" value="MBA / MSc">MBA / MSc</option>
                        <option label="MBBS" value="MBBS">MBBS</option>
                        <option label="Degree" value="Degree">Degree</option>
                        <option label="HND" value="HND">HND</option>
                        <option label="OND" value="OND">OND</option>
                        <option label="N.C.E" value="N.C.E">N.C.E</option>
                        <option label="Diploma" value="Diploma">Diploma</option>
                        <option label="High School (S.S.C.E)" value="High School (S.S.C.E)">High School (S.S.C.E)</option>
                        <option label="Vocational" value="Vocational">Vocational</option>
                        <option label="Others" value="Others">Others</option>
                    </select>
                </div>
              </div>
              <div class="row">
                    <div class="small-2 columns">
                        <label> Grade</label>
                    </div>
                    <div class="small-10 columns">
                        <select name="grade" id="grade" class="input-large">
                            <option value="">No classification</option>
                            <option label="First Class/Distinction" value="First Class/Distinction">First Class/Distinction</option>
                            <option label="Second Class Upper/Upper Credit" value="Second Class Upper/Upper Credit">Second Class Upper/Upper Credit</option>
                            <option label="Second Class Lower/Lower Credit" value="Second Class Lower/Lower Credit">Second Class Lower/Lower Credit</option>
                            <option label="Third Class" value="Third Class">Third Class</option>
                            <option label="Pass" value="Pass">Pass</option>
                        </select>
                    </div>
              </div>
              <div class="row">
                <div class="small-2 columns">
                <label for="right-label" class="left inline">Certificate Obtained</label>
                </div>
                <div class="small-10 columns">
                    <input type="text" name="cert" id="cert" />
                </div>
              </div>
              <a href="#" id="btnins" name="btnins" class="button">Add New Institute</a>
            </div>
           </div>
          </section>
          <section>
            <p class="title" data-section-title><a href="#panel2">Work Experience</a></p>
            <div class="content" data-section-content>
            <p><h4>Work Experience</h4><i>Employee work experience</i></p>
            <div id="tblwk">
                <?php echo $this->empwkexpy; ?>            	
            </div>
            <a href="#" id="triglink2"><img id="" src="public/icons/Add16.png" /> Add New</a>
            <hr />
            <div id="divwk" style="display: none; background-color:#768b96; padding: 10px; color: #fff;">
                <div class="row">
                    <div class="small-2 columns">
                    <label for="right-label" class="left inline">Job Title</label>
                    </div>
                    <div class="small-10 columns">
                        <input name="jobtitle" id="jobtitle" placeholder="Web Designer" value="" type="text" title="Please specify the Employee  or portfolio occupied in the previouse organisation." class=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="small-2 columns">
                    <label for="right-label" class="left inline">Job Type</label>
                    </div>
                    <div class="small-10 columns">
                        <select name="jobtype" id="jobtype" class="input-small" title="Please specify work type" style="width: 90px; margin-right: 5px;"><option label="Full-Time" value="1">Full-Time</option>
        <option label="Intern" value="2">Intern</option>
        <option label="Contract" value="3">Contract</option>
        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="small-2 columns">
                    <label for="right-label" class="left inline">company</label>
                    </div>
                    <div class="small-10 columns">
                        <input name="company" placeholder="Company" id="company" value="" type="text" title="Please specify the organisation which Employee worked with" />
                    </div>
                </div>
                <div class="row">
                    <div class="small-2 columns">
                    <label for="right-label" class="left inline">company</label>
                    </div>
                    <div class="small-10 columns">
                        <input name="compaddress" placeholder="Company Address" id="compaddress" value="" type="text" title="Please specify the organisation which Employee worked with" />
                    </div>
                </div>
                <div class="row">
                    <div class="small-2 columns">
                    <label for="right-label" class="left inline">Year</label>
                    </div>
                    <div class="small-10 columns">
                        <div class="small-1 columns"><label>From</label></div>
                        <div class="small-5 columns">
                            <select id="empdatefro" name="empdatefro" >
                               
                                <option label="Year" value="">Year</option>
                                <option label="1970" value="1970">1970</option>
                                <option label="1971" value="1971">1971</option>
                                <option label="1972" value="1972">1972</option>
                                <option label="1973" value="1973">1973</option>
                                <option label="1974" value="1974">1974</option>
                                <option label="1975" value="1975">1975</option>
                                <option label="1976" value="1976">1976</option>
                                <option label="1977" value="1977">1977</option>
                                <option label="1978" value="1978">1978</option>
                                <option label="1979" value="1979">1979</option>
                                <option label="1980" value="1980">1980</option>
                                <option label="1981" value="1981">1981</option>
                                <option label="1982" value="1982">1982</option>
                                <option label="1983" value="1983">1983</option>
                                <option label="1984" value="1984">1984</option>
                                <option label="1985" value="1985">1985</option>
                                <option label="1986" value="1986">1986</option>
                                <option label="1987" value="1987">1987</option>
                                <option label="1988" value="1988">1988</option>
                                <option label="1989" value="1989">1989</option>
                                <option label="1990" value="1990">1990</option>
                                <option label="1991" value="1991">1991</option>
                                <option label="1992" value="1992">1992</option>
                                <option label="1993" value="1993">1993</option>
                                <option label="1994" value="1994">1994</option>
                                <option label="1995" value="1995">1995</option>
                                <option label="1996" value="1996">1996</option>
                                <option label="1997" value="1997">1997</option>
                                <option label="1998" value="1998">1998</option>
                                <option label="1999" value="1999">1999</option>
                                <option label="2000" value="2000">2000</option>
                                <option label="2001" value="2001">2001</option>
                                <option label="2002" value="2002">2002</option>
                                <option label="2003" value="2003">2003</option>
                                <option label="2004" value="2004">2004</option>
                                <option label="2005" value="2005">2005</option>
                                <option label="2006" value="2006">2006</option>
                                <option label="2007" value="2007">2007</option>
                                <option label="2008" value="2008">2008</option>
                                <option label="2009" value="2009">2009</option>
                                <option label="2010" value="2010">2010</option>
                                <option label="2011" value="2011">2011</option>
                                <option label="2012" value="2012">2012</option>
                                <option label="2013" value="2013" selected="selected">2013</option>
                                <option label="2014" value="2014">2014</option>
                            </select>
                        </div>
                        <div class="small-1 columns"><label>To</label></div>
                        <div class="small-5 columns">
                            <select id="empdateto" name="empdateto" class="large-12 columns">
                                <option label="Year" value="">Year</option>
                                <option label="1970" value="1970">1970</option>
                                <option label="1971" value="1971">1971</option>
                                <option label="1972" value="1972">1972</option>
                                <option label="1973" value="1973">1973</option>
                                <option label="1974" value="1974">1974</option>
                                <option label="1975" value="1975">1975</option>
                                <option label="1976" value="1976">1976</option>
                                <option label="1977" value="1977">1977</option>
                                <option label="1978" value="1978">1978</option>
                                <option label="1979" value="1979">1979</option>
                                <option label="1980" value="1980">1980</option>
                                <option label="1981" value="1981">1981</option>
                                <option label="1982" value="1982">1982</option>
                                <option label="1983" value="1983">1983</option>
                                <option label="1984" value="1984">1984</option>
                                <option label="1985" value="1985">1985</option>
                                <option label="1986" value="1986">1986</option>
                                <option label="1987" value="1987">1987</option>
                                <option label="1988" value="1988">1988</option>
                                <option label="1989" value="1989">1989</option>
                                <option label="1990" value="1990">1990</option>
                                <option label="1991" value="1991">1991</option>
                                <option label="1992" value="1992">1992</option>
                                <option label="1993" value="1993">1993</option>
                                <option label="1994" value="1994">1994</option>
                                <option label="1995" value="1995">1995</option>
                                <option label="1996" value="1996">1996</option>
                                <option label="1997" value="1997">1997</option>
                                <option label="1998" value="1998">1998</option>
                                <option label="1999" value="1999">1999</option>
                                <option label="2000" value="2000">2000</option>
                                <option label="2001" value="2001">2001</option>
                                <option label="2002" value="2002">2002</option>
                                <option label="2003" value="2003">2003</option>
                                <option label="2004" value="2004">2004</option>
                                <option label="2005" value="2005">2005</option>
                                <option label="2006" value="2006">2006</option>
                                <option label="2007" value="2007">2007</option>
                                <option label="2008" value="2008">2008</option>
                                <option label="2009" value="2009">2009</option>
                                <option label="2010" value="2010">2010</option>
                                <option label="2011" value="2011">2011</option>
                                <option label="2012" value="2012">2012</option>
                                <option label="2013" value="2013" selected="selected">2013</option>
                                <option label="2014" value="2014">2014</option>
                            </select>
                        </div>
                    </div>
                  </div>
                <a href="#" id="btnwk" class="button"> Add New Work Exp</a>
           	</div>
           
           
           
           
            </div>
          </section>
          <section>
            <p class="title" data-section-title><a href="#panel3">Next of Kin</a></p>
            <div class="content" data-section-content>
               <p><h4>Next of Kin</h4><i>Names and address of Next of Kin</i></p>
               <div id="tblkin"><?php echo $this->empnok ?></div>
               <a href="#" id="triglink3"><img id="" src="public/icons/Add16.png" /> Add New</a>
               <hr />
               <div id="divaddnox" style="display: none; background-color:#768b96; padding: 10px; color: #fff;">
                    <div class="control-group">
                        <label class="control-label" for="gfname">Full Name</label>
                        <div class="controls">
                        <input type="text" id="gfname" name="gfname" placeholder="Next of King's Full Name"  />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="gaddress">Address</label>
                        <div class="controls">
                        <textarea name="gaddress" id="gaddress" class="span12" cols="" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="gtelephone">Telephone</label>
                       <div class="controls">
                        <input type="text" id="gtelephone" name="gtelephone" placeholder="Telephone">
                       </div>
                      </div> 
                    <div class="control-group">
                            <label class="control-label" for="gemail">Email</label>
                        <div class="controls">
                            <input type="text" id="gemail" name="gemail" placeholder="Email">
                        </div>
                    </div> 
                    <div class="control-group">
                        <label class="control-label" for="relationship">Relationship</label>
                            <div class="controls">
                                <input type="text" id="grelationship" name="grelationship" placeholder="Relationship">
                            </div>
                    </div>
                    <a href="#" id="btnnox" name="btnnox" class="button">Add new Next of Kin</a>
                </div>
            </div>
          </section>
          <section>
            <p class="title" data-section-title><a href="#panel4">Refrees</a></p>
            <div class="content" data-section-content>
            	<p><h4> Referee</h4><i>Employee referee</i></p>
                <div id="tblref">
                    <?php echo $this->empref; ?>
                </div>
                
                <a href="#" id="triglink4"><img id="" src="public/icons/Add16.png" /> Add New</a>
                <hr />
                <div  id="divref" style="display: none; background-color:#768b96; padding: 10px; color: #fff;">
                <div class="row">
             	<div class="large-6 columns">
                     <div class="control-group">
                        <label class="control-label" for="refname1">Name</label>
                        <div class="controls">
                            <input type="text" id="refname1" name="refname1" placeholder="Referee's Name" >
                        </div>
                     </div>
                     <div class="control-group">
                        <label class="control-label" for="refaddress1">Office Address</label>
                        <div class="controls">
                            <textarea id="refaddress1" name="refaddress1" rows="45" cols="20"  ></textarea>
                        </div>
                     </div>
                     <div class="control-group">
                        <label class="control-label" for="refdesignation1">Designation</label>
                        <div class="controls">
                            <input type="text" id="refdesignation1" name="refdesignation1" placeholder="Designation">
                        </div>
                     </div>
                     <div class="control-group">
                        <label class="control-label" for="refphone1">Telephone</label>
                        <div class="controls">
                            <input type="text" id="refphone1" name="refphone1" placeholder="Telephone">
                        </div>
                     </div>
                     <div class="control-group">
                        <label class="control-label" for="refemail1">E-mail</label>
                        <div class="controls">
                            <input type="text" id="refemail1" name="refemail1" placeholder="Email">
                        </div>
                     </div>
                     <div class="control-group">
                        
                        <div class="controls">
                           <a href="#" id="btnref" name="btnref" class="button"> Add New Referee</a>
                        </div>
                     </div>
                     </div><!-- -->
                 </div></div>
            </div>    
          </section>
          <section>
            <p class="title" data-section-title><a href="#panel5">Employee Role</a></p>
            <div class="content" data-section-content>
            	<p><h4> Role</h4><i>Set up employee role here</i></p>
                        <div class="row">
                        <div id="p"></div>
                            <div class="large-12 columns">
                            <div class="large-4 columns">Select Department</div>
                            <div class="large-8 columns">
                            <select id='empdept' name='empdept'>
                           <option value=''>--SELECT DEPARTMENT--</option>
                            <?php
                            //if(){
                                foreach($this->depts as $dept){
									if(!empty($this->employee->emp_dept)){
										if($this->employee->emp_dept === $dept->id ){
										echo "<option value='{$dept->id}' selected='selected'>$dept->dept_name</option>" /*: ""*/;
										}else{
											echo "";
										}
									}
								echo "<option value='{$dept->id}'>$dept->dept_name</option>";
								}
                           
                            
                            ?></select>
                                </div>
                                
                                
                                
                            <div class="large-4 columns">Select Role</div>
                            <div class="large-8 columns">
                            <select id='emppost' name='emppost'>
                                <option value=''>--SELECT ROLE--</option>
                            <?php
                            
                                foreach($this->role as $role){
									if(!empty($this->employee->emp_post)){
										if((int)$this->employee->emp_post == $role->role_id ){
										echo "<option value='{$role->role_id}' selected='selected'>$role->role_name</option>" /*: ""*/;
										}else{
											echo "";
										}
									}
                                echo "<option value='{$role->role_id}'>$role->role_name</option>";
                                }
                            ?>
                            </select>
                            <a href='#' id='btnrole' name='btnrole' class='button'> Save Role</a>
                                </div>
                            </div>
                        </div>
            </div>    
          </section>
          <section>
            <p class="title" data-section-title><a href="#panel6">Edit Password</a></p>
            <div class="content" data-section-content>
            	<p><h4>Create/Modify</h4><i>Employee password</i></p>
                        <div class="row">
                        <div id="passdiv"></div>
                            <div class="large-12 columns">
                            <div class="large-4 columns">Change Password</div>
                            <div class="large-8 columns">
                            	<input type="password" name="password" id="password" value="" />
                                <a href='#' id='btnpword' name='btnpword' class='button'>Change password</a>
                            </div>
                            </div>
                        
                        </div>
            </div>    
          </section>
        </div>
      </div>
      <div class="row">    
              <input type="hidden" name="task" id="task" value="<?php //echo (isset($_GET['task']) && !empty($_GET['task'])) ? $_GET['task'] : "" ?>">
              <input type="hidden" name="pgid" id="pgid" value="<?php //echo $this->myrole->role_id ?>" />
            
               
           
     </div>            	    
    </fieldset>
</form>



               