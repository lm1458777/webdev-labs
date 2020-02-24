#include "QueryParameters.h"
#include <sstream>

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

optional<pair<string, string>> tryParseNameAndValue(const string &s)
{
    auto parts = split(s, '=');
    if (parts.size() == 2 && !parts.front().empty())
    {
        return pair(
            move(parts.front()),
            move(parts.back()));
    }

    return nullopt;
}

} // namespace

string GetQueryStringParameter(const string &queryString, string_view parameterName)
{
    const auto parameters = QueryParameters(queryString);
    return parameters.value(parameterName).value_or(string());
}

QueryParameters::QueryParameters(const string &queryString)
{
    const auto parts = split(queryString, '&');
    for (const auto &p : parts)
    {
        if (auto nameValuePair = tryParseNameAndValue(p))
        {
            m_parameters.push_back(move(nameValuePair).value());
        }
    }
}

optional<string> QueryParameters::value(string_view parameterName) const
{
    for (const auto &[name, value] : m_parameters)
    {
        if (name == parameterName)
        {
            return value;
        }
    }

    return nullopt;
}
