<?php declare(strict_types = 1);

namespace MailPoet\Automation\Engine\API\Endpoints;

if (!defined('ABSPATH')) exit;


use MailPoet\Automation\Engine\API\Endpoint;
use MailPoet\Automation\Engine\API\Request;
use MailPoet\Automation\Engine\API\Response;
use MailPoet\Automation\Engine\Migrations\Migrator;
use MailPoet\Features\FeatureFlagsController;
use MailPoet\Features\FeaturesController;

class SystemDatabaseEndpoint extends Endpoint {
  /** @var FeatureFlagsController */
  private $featureFlagsController;

  /** @var Migrator */
  private $migrator;

  public function __construct(
    FeatureFlagsController $featureFlagsController,
    Migrator $migrator
  ) {
    $this->migrator = $migrator;
    $this->featureFlagsController = $featureFlagsController;
  }

  public function post(Request $request): Response {
    $this->migrator->deleteSchema();
    $this->migrator->createSchema();
    return new Response(null);
  }

  public function delete(Request $request): Response {
    $this->migrator->deleteSchema();
    $this->featureFlagsController->set(FeaturesController::AUTOMATION, false);
    return new Response(null);
  }
}
