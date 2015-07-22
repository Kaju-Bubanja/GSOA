/*TODO:

- Make command line take year and which file to open
- Find end of for loop condition
- Special characters ?

*/

#include <iostream>
#include <fstream>
#include <string>
#include <sstream>
#include <boost/algorithm/string/find.hpp>
using namespace std;
using namespace boost;

int main(){
  string line;
  ifstream myfile ("gsoa2006.csv", ios::binary);
  ofstream outfile ("gsoa2006.sql");
  string eu = "Europa";
  string af = "Afrika";
  string am = "Amerika";
  string as = "Asien";
  string au = "Australien";
  if (myfile.is_open())
  {
    while ( getline (myfile,line) )
    {
      if(line.compare(0,6,eu) == 0){
        
        stringstream tmp;
        
        size_t startX = line.find_first_of(";");
        size_t endX = line.find_first_of("/");
        
        int startLand = static_cast<int>(startX) + 1;
        int endLand = static_cast<int>(endX) - 1;
        int lengthLand = endLand - startLand;
        
        for(int i = 2; i < TODETERMIN; i++) {
          iterator_range<string::iterator> startKategoriesX = find_nth(line, ";", i);
          int startKategories = distance(line.begin(), startKategoriesX.begin()) + 1;
          iterator_range<string::iterator> endKategoriesX = find_nth(line, ";", i+1);
          int endKategories = distance(line.begin(), endKategoriesX.begin());
          
          int waasenaarCounter = 1;
          
          cout << "HERE COME IMPORTANT STUFF" << endl;
          cout << startKategories << endl; 
          
          tmp << "CALL export_insert( " << line.substr(startLand, lengthLand) 
            << ", Kriegsmaterial, Wassenaar, KM" << waasenaarCounter << ", " << line.substr(startKategories, endKategories) << ", "
            <<  
  
  
          outfile << tmp.str();
        }
        cout << "SHOOP DA WHOOP" << '\n';
      }
      else if(line.compare(0,6,af) == 0){
        stringstream tmp;
        cout << "SHOOP DA WHOOP" << '\n';
      }
      else if(line.compare(0,7,am) == 0){
        stringstream tmp;
        cout << "SHOOP DA WHOOP" << '\n';
      }
      else if(line.compare(0,5,as) == 0){
        stringstream tmp;
        cout << "SHOOP DA WHOOP" << '\n';
      }
      else if(line.compare(0,10,au) == 0){
        stringstream tmp;
        cout << "SHOOP DA WHOOP" << '\n';
      }
      cout << line << '\n';
    }
    myfile.close();
  }

  else cout << "Unable to open file"; 

  return 0;
}
