import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from  '../auth.service';
import { Router } from  '@angular/router';

@Component({
  selector: 'app-employee',
  templateUrl: './employee.component.html',
  styleUrls: ['./employee.component.scss']
})
export class EmployeeComponent implements OnInit {

  employeetitle:string;
  employeeForm: FormGroup;
  submitted = false;
  success = false;

  constructor(private formBuilder: FormBuilder,private authService: AuthService,private router: Router) { }

  ngOnInit() {
    this.authService.isLoggedIn();
    this.employeetitle = "Create New Employee";

      this.employeeForm = this.formBuilder.group({
        empname: ['', Validators.required],
        empcode: ['', Validators.required],
        empdepartment:['', Validators.required],
        empdesignation:['', Validators.required],
        empreportingemployee:['', Validators.required],
        empmobilenumber:['', Validators.required],
        empemmail:['', Validators.required],
        empjoiningdate:['', Validators.required],

        

        
      });
  }

  onSubmit() {
      this.submitted = true;
      if (this.employeeForm.invalid) {
          return;
      }
      this.success = true;
  }

  backtolist(){
    this.router.navigateByUrl('/employeelist');
  }

}
