/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function cliente(nombre,saldo)
{
    this.nombre=nombre;
    this.saldo=saldo;
    this.depositar=depositar;
    this.extraer=extraer;
}

function depositar(dinero)
{
    this.saldo=this.saldo+dinero;
}

function extraer(dinero)
{
    this.saldo=this.saldo-dinero;
}

