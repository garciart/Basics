/**
 * @file dev.cpp
 * @author your name (you@domain.com)
 * @brief 
 * @version 0.1
 * @date 2020-05-17
 * 
 * @copyright Copyright (c) 2020
 * 
 */

#include <ctime>
#include <iomanip>
#include <iostream>
#include <sstream>
#include <string>

using namespace std;

int main()
{
    time_t now = time(0);
    tm *ltm = localtime(&now);
    stringstream ss;
    ss << (1900 + ltm->tm_year) << "-"
     << setw(2) << setfill('0') << ltm->tm_mon << "-"
     << setw(2) << setfill('0') << ltm->tm_mday << " "
     << setw(2) << setfill('0') << ltm->tm_hour << "-"
     << setw(2) << setfill('0') << ltm->tm_min << "-"
     << setw(2) << setfill('0') << ltm->tm_sec << endl;
    cout << ss.str();
    return EXIT_SUCCESS;
}
