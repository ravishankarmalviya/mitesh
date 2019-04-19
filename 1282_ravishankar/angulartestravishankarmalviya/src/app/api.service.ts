import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { Policy } from  './policy';
import { Employeemanagement } from  './employeemanagement';

import { Orgenization } from  './orgenization';
import { Employee } from  './employee';
import { Observable } from  'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
    PHP_API_SERVER = "http://localhost";

  constructor(private httpClient: HttpClient) {}

  readPolicies(): Observable<Employeemanagement[]>{
    return this.httpClient.get<Employeemanagement[]>(`${this.PHP_API_SERVER}/api/read.php`);
  }
  

  createPolicy(employeemanagement: Employeemanagement): Observable<Employeemanagement>{
    return this.httpClient.post<Employeemanagement>(`${this.PHP_API_SERVER}/api/create.php`, employeemanagement);
  }

  updatePolicy(employeemanagement: Employeemanagement){
    return this.httpClient.put<Employeemanagement>(`${this.PHP_API_SERVER}/api/update.php`, employeemanagement);   
  }

  deletePolicy(id: number){
    return this.httpClient.delete<Employeemanagement>(`${this.PHP_API_SERVER}/api/delete.php/?id=${id}`);
  }

  readgetorgenizations(): Observable<Orgenization[]>{ 
    return this.httpClient.get<Orgenization[]>(`${this.PHP_API_SERVER}/api/read_orgenizations.php`);
  }

  readgetemployee(): Observable<Employee[]>{ 
    return this.httpClient.get<Employee[]>(`${this.PHP_API_SERVER}/api/read_employee.php`);
  }
}