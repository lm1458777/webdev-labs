#include "QueryStringParser.h"
#include <vector>
#include <sstream>
#include <iostream>

using namespace std;

namespace
{

vector<string> split(const string &s, char delimiter)
{
    vector<string> tokens;
    string token;
    istringstream tokenStream(s);
    while (getline(tokenStream, token, delimiter))
    {
        tokens.push_back(token);
    }
    return tokens;
}

bool stringStartsWith(const string &s, string_view prefix)
{
    return 0 == s.rfind(prefix, 0);
}

} // namespace

string GetQueryStringParameter(const string &queryString, string_view parameterName)
{
    const auto nameValuePairs = split(queryString, '&');

    auto it = std::find_if(nameValuePairs.begin(), nameValuePairs.end(), [parameterName](const string &nameValuePair) {
        return stringStartsWith(nameValuePair, parameterName);
    });
    if (it != nameValuePairs.end())
    {
        auto nameValuePair = split(*it, '=');
        if (nameValuePair.size() == 2 && nameValuePair.front() == parameterName)
        {
            return move(nameValuePair.back());
        }
    }
    return string();
}