#include "QueryParameters.h"
#include <array>
#include <cstdlib>
#include <iostream>

using namespace std;

namespace
{

const char *const QueryString = "QUERY_STRING";

void printEnvironmentVariables(std::ostream &out)
{
    array<const char *, 5> names = {
        "REQUEST_METHOD",
        QueryString,
        "CONTENT_LENGTH",
        "HTTP_USER_AGENT",
        "HTTP_HOST",
    };

    out << "Environment variables:" << endl;
    for (auto name : names)
    {
        out << name << " = '";
        if (auto value = getenv(name))
        {
            out << value;
        }
        out << "'" << endl;
    }
}

string GetQueryStringParameter(string_view parameterName)
{
    return QueryParameters(getenv(QueryString)).value(parameterName);
}

} // namespace

int main()
{
    const auto name = [] {
        auto name = GetQueryStringParameter("name");
        return name.empty() ? "Anonymous" : name;
    }();

    cout << "Content-Type: text/plain" << endl
         << endl
         << "Hello, " << name << "!" << endl;

    cout << endl;
    printEnvironmentVariables(cout);

    return 0;
}