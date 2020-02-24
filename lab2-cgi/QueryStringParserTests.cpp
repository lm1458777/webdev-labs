#define DOCTEST_CONFIG_IMPLEMENT_WITH_MAIN
#include <doctest/doctest.h>

#include "QueryStringParser.h"

TEST_SUITE_BEGIN("QueryParameters parsing tests");

TEST_CASE("Parsing an empty string")
{
    CHECK_EQ(QueryParameters("").value("parameter"), std::nullopt);
}

TEST_CASE("Parsing a string without a parameter value")
{
    CHECK_EQ(QueryParameters("name").value("name"), std::nullopt);
    CHECK_EQ(QueryParameters("name=").value("name"), std::nullopt);
}

TEST_CASE("Parsing a string with single value")
{
    const QueryParameters params("name=value");
    CHECK_EQ(params.value("name"), "value");
    CHECK_EQ(params.value("value"), std::nullopt);
}

TEST_SUITE("Parsing a string with multiple values")
{
    const QueryParameters params("n1=p1&n2=&n3");

    TEST_CASE("Parameter has value")
    {
        CHECK_EQ(params.value("n1"), "p1");
        CHECK_EQ(params.value("p1"), std::nullopt);
    }

    TEST_CASE("Parameter has no value")
    {
        CHECK_EQ(params.value("n2"), std::nullopt);
        CHECK_EQ(params.value("n3"), std::nullopt);
    }
}

TEST_SUITE_END();