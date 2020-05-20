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
    char *buffer;
    printf("%4d-%02d-%02d %02d-%02d-%02d", (1900 + ltm->tm_year), ltm->tm_mon, ltm->tm_mday, ltm->tm_hour, ltm->tm_min, ltm->tm_sec);
    stringstream fmt;
    fmt << setw(2) << setfill('0') << (1900 + ltm->tm_year) << "-" << ltm->tm_mon << "-" << ltm->tm_mday << " " << ltm->tm_hour << "-" << ltm->tm_min << "-" << ltm->tm_sec << endl;
    cout << fmt.str();
    sprintf(buffer, "%d-%d-%d %d-%d-%d", (1900 + ltm->tm_year), ltm->tm_mon, ltm->tm_mday, ltm->tm_hour, ltm->tm_min, ltm->tm_sec);
    string formatted_time = buffer;
    cout << buffer;
    return EXIT_SUCCESS;
}
