import {Injectable} from '@angular/core';


export class Grocery {


  name: string;
  amount: number;
  unit: string;
  constructor(name, amount, unit) {
    this.name = name;
    this.amount = amount;
    this.unit = unit;
  }
  getName() {
    return this.name;
  }
  getQuantity() {
    return this.amount;
  }
  getUnit() {
    return this.unit;
  }
}
