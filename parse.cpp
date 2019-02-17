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
      int startLand = static_cast<int>(startX) + 1;
      
      int yearInt = atoi(year.c_str());

      if(yearInt == 2006){
        size_t endX = line.find_first_of("/");
        int endLand = static_cast<int>(endX) - 1;
        
      }

      iterator_range<string::iterator> endLandX = find_nth(line, ";", 1);
      int endLand = distance(line.begin(), endLandX.begin());

      int lengthLand = endLand - startLand;

      if(endLand == -2 || endLand > 40 || lengthLand == 0){
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
          if(line.substr(startLand, lengthLand) == "D?nemark" || line.substr(startLand, lengthLand) == "DŠnemark")
            landTmp = "Dänemark";
          else if(line.substr(startLand, lengthLand) == "?sterreich" || line.substr(startLand, lengthLand) == "…sterreich")
            landTmp = "Österreich";
          else if(line.substr(startLand, lengthLand) == "Rum?nien" || line.substr(startLand, lengthLand) == "RumŠnien")
            landTmp = "Rumänien";
          else if(line.substr(startLand, lengthLand) == "T?rkei" || line.substr(startLand, lengthLand) == "TŸrkei")
            landTmp = "Türkei";
          else if(line.substr(startLand, lengthLand) == "S?dafrika" || line.substr(startLand, lengthLand) == "SŸdafrika")
            landTmp = "Südafrika";
          else if(line.substr(startLand, lengthLand) == "Korea (S?d)" || line.substr(startLand, lengthLand) == "Korea (SŸd)")
            landTmp = "Korea (Süd)";
          else if(line.substr(startLand, lengthLand) == "Bosnien" || line.substr(startLand, lengthLand) == "RumŠnien")
            landTmp = "Bosnien und Herzeg.";
          else if(line.substr(startLand, lengthLand) == "Gr. Britannien" || line.substr(startLand, lengthLand) == "RumŠnien")
            landTmp = "Grossbritannien";
          else if(line.substr(startLand, lengthLand) == "Tschechien" || line.substr(startLand, lengthLand) == "RumŠnien")
            landTmp = "Tschechische Rep.";
          else if(line.substr(startLand, lengthLand) == "Aegypten" || line.substr(startLand, lengthLand) == "?gypten"
           || line.substr(startLand, lengthLand) == "€gypten")
            landTmp = "Ägypten";
          else if(line.substr(startLand, lengthLand) == "USA")
            landTmp = "U.S.A";
          else if(line.substr(startLand, lengthLand) == "Arab. Emirate")
            landTmp = "Arabische Emirate";
          else if(line.substr(startLand, lengthLand) == "Bahrein")
            landTmp = "Bahrain";
          else if(line.substr(startLand, lengthLand) == "Macau")
            landTmp = "Macao";
          else if(line.substr(startLand, lengthLand) == "Saudi Arabien")
            landTmp = "Saudi-Arabien";
          else if(line.substr(startLand, lengthLand) == "Slowakai")
            landTmp = "Slowakei";
          else if(line.substr(startLand, lengthLand) == "Land")
            continue;


          string betrag = line.substr(startKategories, kategoriLength);
          erase_all(betrag, "'");

          tmp << "CALL export_insert( '" << landTmp 
            << "', 'Kriegsmaterial', 'Wassenaar', 'KM" << waasenaarCounter << "', " << year << ", " << betrag
            << ");\n";
          outFile << tmp.str();   
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
