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

void Application::printPersonInfo() const
{
    const auto queryParameters = QueryParameters(m_env(QUERY_STRING).value_or(""));

    auto print = [this, &queryParameters](const char *label, const char *parameterName) {
        m_out << label << ": '" << queryParameters.value(parameterName).value_or("") << "'" << endl;
    };

    m_out << "Person info:" << endl;
    print("First Name", "first_name");
    print("Last Name", "last_name");
    print("Age", "age");
}

void Application::sarahRevere() const
{
    const auto query = QueryParameters{m_env(QUERY_STRING).value_or("")};
    const auto lanterns = query.value("lanterns").value_or("");

    m_out << "SarahRevere:" << endl;
    if (lanterns == "1")
    {
        m_out << "The British are coming by land." << endl;
    }
    else if (lanterns == "2")
    {
        m_out << "The British are coming by sea." << endl;
    }
    else
    {
        m_out << "The North Church shows only \"" << lanterns << "\"." << endl;
    }
}