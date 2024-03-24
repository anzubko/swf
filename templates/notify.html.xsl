<?xml version="1.0" encoding="utf-8" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" encoding="utf-8" indent="yes" doctype-system="about:legacy-compat" />

  <xsl:template match="/">
    <xsl:apply-templates />
  </xsl:template>

  <xsl:template match="/root">
    <html>
      <head />
      <body>
        <xsl:apply-templates select="." mode="contents" />
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>
