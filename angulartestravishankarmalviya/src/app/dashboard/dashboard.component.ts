import { Component, OnInit,ViewChild,Pipe,PipeTransform} from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatTableDataSource, MatSort, MatPaginator } from '@angular/material';
import { ApiService } from '../api.service';
import { Policy } from  '.././policy';
import { Employeemanagement } from  '.././employeemanagement';
import { Article } from '../article';
import { Orgenization } from  '../orgenization';
import { Employee } from  '../employee';
import { AuthService } from  '../auth.service';


import { ArticleService } from '../article.service';

@Pipe({
  name: 'filter'
})

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

  @ViewChild(MatSort) sort: MatSort;
  @ViewChild(MatPaginator) paginator: MatPaginator; 

  message = " ";
  success = false;
  valiedesuccess = false; 
  submitbuttontrue = true;
  formonlyview=true;
  userlogedin=false;

    policies:  Policy[];
    employeemanagement:  Employeemanagement[];
    orgenizations:  Orgenization[];
    employee:  Employee[];
    selectedPolicy:  Employeemanagement  = { id :  null , orgname:null, dateoftraining:  null,placeoftraning : null,purposeoftraining:null,employee:null};

    

  

  displayedColumns: string[] = ['id', 'placeoftraning', 'dateoftraining', 'purposeoftraining',"actions"];
  fleetData = null;
  messageForm: FormGroup;
  dataSource = new MatTableDataSource(this.articleService.getAllArticles());
  

  constructor(private authService: AuthService,private apiService: ApiService,private articleService: ArticleService,private formBuilder: FormBuilder) { 

    this.articleService.readPolicies().subscribe(data =>{
      this.fleetData = data ;
      this.dataSource.data = this.fleetData;
    });
  }

  ngOnInit() {
    this.authService.isLoggedIn();
    this.messageForm = this.formBuilder.group({
      name: ['', Validators.required],
      message: ['', Validators.required]
    });

        
    this.dataSource.sort = this.sort;
    this.dataSource.paginator = this.paginator;
    //this.getrecords();
    this.getorgenizations();
    this.getoemployee(); 
  }

  createOrUpdatePolicy(form){
    

    if(form.value.dateoftraining === null && form.value.employee === null && form.value.orgname === null && form.value.placeoftraning === null && form.value.purposeoftraining === null){
      this.message = " Employee form field required ";
      this.valiedesuccess = true;

    }else{

    
    
    if(this.selectedPolicy && this.selectedPolicy.id){
      form.value.id = this.selectedPolicy.id;
      this.apiService.updatePolicy(form.value).subscribe((employeemanagement: Employeemanagement)=>{
        console.log("Policy updated"+employeemanagement);
        this.message = " Employee updated ";
        this.success = true;
        this.selectedPolicy = { id :  null , orgname:null, dateoftraining:  null,placeoftraning : null,purposeoftraining:null,employee:null};
        ;
        this.getrecords();
      });

      form.reset();
      form.value.id='';
      this.ngOnInit();
      
    
    }
    else{
      form.value.id = " ";
      this.apiService.createPolicy(form.value).subscribe((employeemanagement: Employeemanagement)=>{
        console.log("Policy created, "+ employeemanagement);
        this.message = " Employee created ";
        this.success = true;
      });

    form.reset();
    this.ngOnInit();
    this.getrecords();
  }
      
    }
    
    
  }

  selectPolicy(employeemanagement: Employeemanagement){
    console.log(employeemanagement);
    this.selectedPolicy = employeemanagement;
    this.formonlyview = true;
  }

  viewemployee(employeemanagement: Employeemanagement){
    console.log(employeemanagement);
    this.selectedPolicy = employeemanagement; 
    this.formonlyview = false;
  }

  

  deletePolicy(id){
    
    if(confirm("are you sure ")){


      this.apiService.deletePolicy(id).subscribe((employeemanagement: Employeemanagement)=>{
        console.log("Policy deleted, ", employeemanagement);
          this.message = " Employee  deleted ";
          this.success = true;
      });
      this.ngOnInit();
    }

    this.getrecords();
    
  }

  getrecords(){

    this.articleService.readPolicies().subscribe(data =>{
      this.dataSource = new MatTableDataSource(data);
      this.dataSource.sort = this.sort;
       this.dataSource.paginator = this.paginator;
    }); 

    

  }

  getorgenizations(){
    this.apiService.readgetorgenizations().subscribe((orgenization: Orgenization[])=>{
      this.orgenizations = orgenization;
      console.log(this.orgenizations);
    });

  }

  getoemployee(){
    this.apiService.readgetemployee().subscribe((employee: Employee[])=>{
      this.employee = employee;
      
    });

  }


  doFilter() {
    
    this.dataSource.filter = this.messageForm.controls.name.value.trim().toLocaleLowerCase();
  }

  resetdoFilter(){
    //this.messageForm.controls.name.value = "";
    //this.messageForm.reset;
    this.getrecords();
    this.ngOnInit();
  }
  

}
