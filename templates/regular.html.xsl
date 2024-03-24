<?xml version="1.0" encoding="utf-8" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" encoding="utf-8" indent="yes" doctype-system="about:legacy-compat" />

  <xsl:template match="/">
    <xsl:apply-templates />
  </xsl:template>

  <xsl:template match="/root" mode="title" />

  <xsl:template match="/root">
    <html>
      <head>
        <xsl:if test="not(registry/robots = 1)">
          <meta name="robots" content="noindex,nofollow" />
        </xsl:if>
        <title>
          <xsl:apply-templates select="." mode="title" />
        </title>
        <base href="{registry/url}" />
        <link rel="stylesheet" type="text/css" href="{registry/merged/all.css}" />
        <link rel="shortcut icon" href="/.media/favicon.ico" />
      </head>
      <body>
        <div>
          <xsl:apply-templates select="." mode="contents" />
        </div>
        <script src="{registry/merged/all.js}" />
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>
