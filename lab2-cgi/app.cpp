#include "app.h"
#include "QueryParameters.h"
#include <array>
#include <iostream>

using namespace std;

namespace
{

const char *const QUERY_STRING = "QUERY_STRING";

} // namespace

Application::Application(std::ostream &out, EnvironmentVariables env)
    : m_out(out), m_env(move(env))
{
}

void Application::sayHello() const
{
    string name = "Anonymous";
    if (auto queryString = m_env(QUERY_STRING))
    {
        if (auto n = QueryParameters(*queryString).value("name"))
        {
            if (!n->empty())
            {
                name = *move(n);
            }
        }
    }

    m_out << "Hello, " << name << "!" << endl;
}

void Application::printEnvironmentVariables() const
{

    array<const char *, 5> names = {
        "REQUEST_METHOD",
        QUERY_STRING,
        "CONTENT_LENGTH",
        "HTTP_USER_AGENT",
        "HTTP_HOST",
    };

    m_out << "Environment variables:" << endl;
    for (auto name : names)
    {
        m_out << name << " = '";
        if (auto value = m_env(name))
        {
            m_out << *value;
        }
        m_out << "'" << endl;
    }
}
