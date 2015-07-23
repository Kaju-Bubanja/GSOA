/*TODO:

- Find end of for loop condition
- Special characters ?

*/

#include <iostream>
#include <fstream>
#include <string>
#include <sstream>
#include <boost/algorithm/string/find.hpp>
#include <boost/algorithm/string.hpp>
using namespace std;
using namespace boost;

int main(int argc, char* argv[]){
  if(argc < 2){
    cout << "not enough parameters" << endl;
    return 0;
  }
  string line;
  string year = argv[1];
  
  stringstream inputFileName;
  inputFileName << "gsoa" << year << ".csv";
  ifstream inFile (inputFileName.str().c_str(), ios::binary);
  
  stringstream outputFileName;
  outputFileName << "gsoa" << year << ".sql";
  ofstream outFile (outputFileName.str().c_str());
  
  if (inFile.is_open())
  {
    while ( getline (inFile,line) )
    {   
      
      size_t startX = line.find_first_of(";");
      size_t endX = line.find_first_of("/");
      
      int startLand = static_cast<int>(startX) + 1;
      int endLand = static_cast<int>(endX) - 1;
      int lengthLand = endLand - startLand;
      
      if(endLand == -2 || endLand > 40){
        continue;
      }

      int waasenaarCounter = 1;
      for(int i = 0; i < 10; i++) {
        iterator_range<string::iterator> startKategoriesX = find_nth(line, ";", i+2);
        int startKategories = distance(line.begin(), startKategoriesX.begin()) + 1;
        iterator_range<string::iterator> endKategoriesX = find_nth(line, ";", i+3);
        int endKategories = distance(line.begin(), endKategoriesX.begin());
        int kategoriLength = endKategories - startKategories;
        if(kategoriLength != 0){ 
          stringstream tmp;
          string landTmp = line.substr(startLand, lengthLand);
          if(line.substr(startLand, lengthLand) == "D?nemark")
            landTmp = "Dänemark";
          else if(line.substr(startLand, lengthLand) == "?sterreich")
            landTmp = "Österreich";
          else if(line.substr(startLand, lengthLand) == "Rum?nien")
            landTmp = "Rumänien";
          else if(line.substr(startLand, lengthLand) == "T?rkei")
            landTmp = "Türkei";
          else if(line.substr(startLand, lengthLand) == "S?dafrika")
            landTmp = "Südafrika";
          else if(line.substr(startLand, lengthLand) == "Korea (S?d)")
            landTmp = "Korea (Süd)";
          tmp << "CALL export_insert( " << landTmp 
            << ", Kriegsmaterial, Wassenaar, KM" << waasenaarCounter << ", " << year << ", " << line.substr(startKategories, kategoriLength)
            << ");\n";
          string tmp2 = tmp.str();
          erase_all(tmp2, "'");
          outFile << tmp2;   
        }
        if(waasenaarCounter == 8){
          waasenaarCounter++;
        }
        if(waasenaarCounter == 10){
          waasenaarCounter = 15;
        }
        waasenaarCounter++;
        
        
        }
    }
    inFile.close();
    outFile.close();
  }
  else cout << "Unable to open file"; 

  return 0;
}
